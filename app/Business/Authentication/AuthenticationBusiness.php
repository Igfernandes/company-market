<?php

namespace App\Business\Authentication;

use App\Database\Entities\Users\RememberEntity;
use App\Database\Entities\Users\UserAuthHistoryEntity;
use App\Database\Entities\Users\UserEntity;
use App\Database\Models\Users\RememberModel;
use App\Database\Models\Users\UsersAuthHistoryModel;
use App\Libraries\Tokens\Tokens;

class AuthenticationBusiness
{
    private Tokens $tokens;

    public function __construct()
    {
        $this->tokens = new Tokens();
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

    public static function hasCSRFAvailable()
    {
        $request = service('request');
        $security = service('security');

        // Obter o nome do token (ex.: 'X-CSRF-TOKEN')
        $tokenName = $security->getCSRFTokenName();
        $tokenNamePartes = \explode("_", $tokenName);
        $tokenNameUcfirst = \array_map(fn($word) => \ucfirst($word), $tokenNamePartes);
        $tokenFixedName = join("-", $tokenNameUcfirst);

        // Obter o valor enviado no header ou no body
        $token = $request->getHeaderLine($tokenFixedName);
        $hash = $security->getCSRFHash();
        
        return !hash_equals($hash, $token);
    }
}
