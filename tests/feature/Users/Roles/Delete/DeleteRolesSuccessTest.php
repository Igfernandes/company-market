<?php

namespace Tests\Feature\Roles\Delete;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Mocks\Users\RolesMock;
use Tests\Support\Sessions\AuthenticatedSession;
use Tests\Support\Traits\Users\RolesTrait;

class DeleteRolesSuccessTest extends RolesMock
{
    use FeatureTestTrait, AuthenticatedSession, RolesTrait;

    private string $route = '/api/users/roles';

    /**
     * Cenário: payload inválido causa exceção
     */
    public function testDeleteUser()
    {
        $this->createAuthenticatedSession(1);

        $id = $this->getId(SELF::DATA['0']['name']);

        $result = $this->delete("{$this->route}/" . $id);

        $result->assertJSONFragment([
            "success" => "Api.roles.success.delete"
        ]);
        $result->assertStatus(ResponseInterface::HTTP_OK);
    }
}
