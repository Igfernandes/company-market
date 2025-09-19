<?php

namespace Tests\Feature\Users\Roles\Permissions\Get;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Mocks\Users\RolesMock;
use Tests\Support\Sessions\AuthenticatedSession;

class GetFailedTest extends RolesMock
{
    use FeatureTestTrait, AuthenticatedSession;

    private string $route = '/api/users/roles';

    /**
     * Cenário: payload inválido causa exceção
     */
    public function testInvalidRoleId()
    {
        $this->createAuthenticatedSession();
        $result = $this->call('get', "{$this->route}/none/permissions");

        $result->assertJSONFragment([]);
        $result->assertStatus(ResponseInterface::HTTP_NOT_FOUND);
    }
}
