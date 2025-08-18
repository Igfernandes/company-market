<?php

namespace App\Business\Authentications;

use App\Business\BaseBusiness;
use App\Database\Entities\Users\RememberEntity;
use App\Database\Entities\Users\UserEntity;
use App\Database\Models\Users\RememberModel;
use App\Database\Models\Users\UsersModel;
use App\Libraries\Tokens\Tokens;

class RememberBusiness
{
    use BaseBusiness;
    private Tokens $tokens;

    public function __construct()
    {
        $this->tokens = new Tokens();
    }

    public function createTokenRemember(array $payload, UserEntity $user, object $userSettings)
    {
        if (!isset($payload['remember-me']) || empty($payload['remember-me']))  return;

        $rememberModal = new RememberModel();
        $rememberEntity = new RememberEntity();

        $tokenRemember = $this->tokens->create(3);

        $rememberEntity->fill([
            "token" => $tokenRemember,
            "user_id" =>  $user->getId(),
            "ip" =>  $userSettings->ip == "::1" ? "127.0.0.1" : $userSettings->ip
        ]);

        $rememberModal->upsert(["user_id" => $user->getId()], $rememberEntity);

        return $tokenRemember;
    }

    /**
     * Verifica se o token "remember-me" é válido
     *
     * @param string $token O token de lembrar-me
     * @param object{ip:string,browser:string}|null $userSettings Informações do usuário (IP e navegador)
     * @return bool|UserEntity Retorna o usuário se válido, ou false se inválido
     */
    public static function isRememberTokenValid(string $token, ?Object $userSettings = null): bool|UserEntity
    {
        $rememberEntity = new RememberEntity();
        $rememberModel = new RememberModel();

        $request = \Config\Services::request();
        $browser = !empty($userSettings) ? $userSettings->browser :  $request->getUserAgent()->getBrowser();
        $ipAddress = !empty($userSettings) ? $userSettings->ip : $request->getIPAddress();
        $ipAddress = $ipAddress == "::1" ? "127.0.0.1" : $ipAddress;

        $rememberEntity->setToken($token);
        $rememberEntity->setIp($ipAddress);

        $foundRemember = $rememberModel->where($rememberEntity->toArray(true))->first();

        if (empty($foundRemember))
            return false;

        $usersModel = new UsersModel();
        $foundUser = $usersModel->where("id", $foundRemember->getUserId())->first();

        if (empty($foundUser))
            return false;

        $userAuthHistoryBusiness = new UserAuthHistoryBusiness();
        $userAuthHistoryBusiness->store($foundUser->getId(), (object)[
            "ip" => $ipAddress,
            "browser" => $browser
        ]);

        $session = \session();
        $session->set(SESSION_KEY_AUTH_USER, $foundUser);

        return $foundUser;
    }

    public static function revokeRememberToken(int $userId): bool
    {
        $rememberModel = new RememberModel();
        return  $rememberModel->where("user_id", $userId)->delete();
    }
}
