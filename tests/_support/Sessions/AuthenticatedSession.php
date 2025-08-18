<?php

namespace Tests\Support\Sessions;

use App\Database\Entities\Users\UserEntity;

trait AuthenticatedSession
{

    private function createAuthenticatedSession()
    {
        $userAuth = new UserEntity([
            'id'   => 1,
            'name' => 'Igor Fernandes',
        ]);

        // Cria um mock da sessão
        $sessionMock = $this->createMock(\CodeIgniter\Session\Session::class);
        $sessionMock->method('get')
            ->with(SESSION_KEY_AUTH_USER)
            ->willReturn($userAuth);

        // Injeta o mock como serviço
        \Config\Services::injectMock('session', $sessionMock);
    }
}
