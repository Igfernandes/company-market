<?php

namespace App\Api\Authentications\Auth;

use App\Database\Entities\Users\RememberEntity;
use App\Database\Entities\Users\UserAuthHistoryEntity;
use App\Database\Entities\Users\UserEntity;
use App\Database\Models\Users\RememberModel;
use App\Database\Models\Users\UsersAuthHistoryModel;
use App\Database\Models\Users\UsersModel;
use App\Libraries\Crypto\Crypto;
use App\Libraries\Exceptions\Exceptions;
use App\Libraries\Tokens\Tokens;

class PostUseCases
{
    private Tokens $tokens;

    public function __construct()
    {
        $this->tokens = new Tokens();
    }

    /**
     * @param array{email:string,password:string,g-recaptcha-response:string.rememberMe:string|null} $payload
     * @param object{browser:string;ip:string} $userSettings
     */
    public function execute(array $payload, object $userSettings)
    {
        if (!validateRecaptcha($payload['g-recaptcha-response']))
            throw new Exceptions(lang("Validation.recaptcha"), BAD_REQUEST);

        $crypto = new Crypto();
        $userModel = new UsersModel();
        $systemKey = $crypto->encrypt($payload['login'] . ":" . $payload['password'], getenv('system.encrypted_key'));
        $userEntity = new UserEntity();

        $userEntity->setSystemKey($systemKey);
        $userEntity->setEncryptEmail($payload['login']);
        $userEntity->setEncryptPassword($payload['password']);

        $foundUser = $userModel->where($userEntity->toArray(true))->first();

        if (empty($foundUser))
            throw new Exceptions(lang("Api.authentications.auth.post.credentials_invalid"), BAD_BUSINESS_RULES);

        $tokenNavigation = $this->createTokenNavigation($foundUser, $userSettings);

        $response = (object)[
            "success" => lang("Api.authentications.auth.post.success"),
            "token_navigation" => $tokenNavigation
        ];

        $tokenRemember = $this->createTokenRemember($payload, $foundUser);

        if (!empty($tokenRemember))
            $response->reference_token = $tokenRemember;

        return $response;
    }

    /**
     * Gera um token de navegação para o usuário, salva o histórico de autenticação
     * e retorna o token gerado.
     *
     * @param UserEntity $user Entidade do usuário para o qual o token será criado.
     * @param object $userSettings Objeto contendo informações do usuário, como navegador e IP.
     *
     * @return string Token de navegação gerado.
     */
    public function createTokenNavigation(UserEntity $user, Object $userSettings): string
    {
        $userAuthHistory = new UserAuthHistoryEntity();
        $userAuthHistoryModel = new UsersAuthHistoryModel();

        deleteCacheWithPrefix($user->getId() . ".");

        $tokenNavigation = $user->getId() . "." .  $this->tokens->create("5");

        $userAuthHistory->setToken($tokenNavigation);
        $userAuthHistory->setUserId($user->getId());
        $userAuthHistory->setBrowser($userSettings->browser);
        $userAuthHistory->setIp($userSettings->ip);

        $userAuthHistoryModel->upsert([
            "user_id" => $user->getId()
        ], $userAuthHistory);

        return $tokenNavigation;
    }


    public function createTokenRemember(array $payload, UserEntity $user)
    {
        if (!isset($payload['rememberMe']) || empty($payload['rememberMe']))  return;

        $rememberModal = new RememberModel();
        $rememberEntity = new RememberEntity();

        $tokenRemember = $this->tokens->create(3);

        $request = \Config\Services::request();
        $ipAddress = $request->getIPAddress();

        $rememberEntity->fill([
            "token" => $tokenRemember,
            "user_id" =>  $user->getId(),
            "ip" =>  $ipAddress ?? '0.0.0.0'
        ]);
        $rememberModal->upsert(["user_id" => $user->getId()], $rememberEntity);

        return $tokenRemember;
    }
}
