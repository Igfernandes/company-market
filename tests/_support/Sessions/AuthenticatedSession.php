<?php

namespace Tests\Support\Sessions;

use App\Database\Entities\Users\UserEntity;

trait AuthenticatedSession
{
    private function createAuthenticatedSession(int $userId = 1)
    {
        // Cria a entidade de usuário
        $userEntity = new UserEntity();
        $userEntity->store([
            'id'   => $userId,
            'name' => 'Igor Fernandes',
        ]);

        $sessionData = [
            SESSION_KEY_AUTH_USER => $userEntity
        ];

        // Cria o mock da sessão
        $sessionMock = $this->createMock(\CodeIgniter\Session\Session::class);

        // Método 'get': retorna o valor da chave ou null
        $sessionMock->method('get')
            ->willReturnCallback(fn($key = null) => $key ? ($sessionData[$key] ?? null) : $sessionData);

        // Método 'set': aceita array ou chave+valor, compatível com CI4
        $sessionMock->method('set')
            ->willReturnCallback(function (...$args) use (&$sessionData) {
                if (count($args) === 1 && is_array($args[0])) {
                    foreach ($args[0] as $key => $value) {
                        $sessionData[$key] = $value;
                    }
                } elseif (count($args) === 2) {
                    $sessionData[$args[0]] = $args[1];
                }
                return true;
            });

        // Injeta o mock como serviço
        \Config\Services::injectMock('session', $sessionMock);

        return $sessionMock;
    }
}
