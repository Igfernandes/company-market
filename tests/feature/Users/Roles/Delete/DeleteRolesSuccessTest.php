<?php

namespace Tests\Feature\Roles\Delete;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Mocks\Users\RolesMock;
use Tests\Support\Sessions\AuthenticatedSession;

class DeleteRolesSuccessTest extends RolesMock
{
    use FeatureTestTrait, AuthenticatedSession;

    private string $route = '/api/users/roles';

    /**
     * Cenário: payload inválido causa exceção
     */
    public function testDeleteUser()
    {
        $this->createAuthenticatedSession(1);

        $payload = SELF::DATA[0];

        $result = $this->delete("{$this->route}/" . $payload['id']);

        $result->assertJSONFragment([
            "success" => "Api.users.roles.success.delete"
        ]);
        $result->assertStatus(ResponseInterface::HTTP_OK);
    }
}
