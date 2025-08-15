<?php

namespace Tests\Sessions\Controllers;

use App\Database\Entities\Users\UserEntity;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Sessions\BaseSessionTests;

class IndexLoginTest extends BaseSessionTests
{
    use FeatureTestTrait;

    /**
     * Testa que usuário não autenticado vê a tela de login
     */
    public function testLoginPageForGuest()
    {
        $result = $this->call('get', 'index/login');

        $result->assertOK();
        $result->assertSee('Login');         // texto da tela
    }


    public function testLoginRedirectForAuthenticatedUser()
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

        // Faz o request normalmente
        $result = $this->call('get', 'index/login');

        // Verifica o redirecionamento
        $result->assertRedirectTo('dashboard/overview');
    }
}
