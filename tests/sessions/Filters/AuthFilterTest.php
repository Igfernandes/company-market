<?php

namespace Tests\Filters;

use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Sessions\BaseSessionTests;

class AuthFilterTest extends BaseSessionTests
{
    use FeatureTestTrait;

    /**
     * Se usuário não autenticado tenta acessar rota protegida, deve redirecionar
     */
    public function testRedirectsIfUserNotAuthenticated()
    {
        $result = $this->call('get', 'dashboard/overview'); // rota protegida

        $result->assertRedirectTo('login'); // redireciona para login
    }

    /**
     * Se usuário autenticado, não deve redirecionar
     */
    public function testDoesNotRedirectIfUserAuthenticated()
    {
        $user = (object)[
            'id' => 1,
            'name' => 'Igor Fernandes',
        ];

        $result = $this->withSession([
            'auth_user' => $user,
        ])->call('get', 'dashboard/overview');

        $result->assertOK(); // não redireciona, mostra a página
    }
}
