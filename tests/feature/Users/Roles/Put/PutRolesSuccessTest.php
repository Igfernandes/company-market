<?php

namespace Tests\Feature\Users\Roles\Put;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Mocks\Users\RolesMock;
use Tests\Support\Sessions\AuthenticatedSession;

class PutRolesSuccessTest extends RolesMock
{
    use FeatureTestTrait, AuthenticatedSession;

    private string $route = '/api/users/roles';

    /**
     * Cenário: payload inválido causa exceção
     */
    public function testUpdateRoles()
    {
        $this->createAuthenticatedSession(2);

        $payload = SELF::DATA[0];
        $id = $payload['id'];
        unset($payload['id']);
        unset($payload['permissions']);

        $result = $this->withBody(json_encode($payload), 'application/json')->put("{$this->route}/" .  $id);

        $result->assertJSONFragment([
            "success" => "Api.roles.success.put"
        ]);
        $result->assertStatus(ResponseInterface::HTTP_OK);
    }

    /**
     * Cenário: payload inválido causa exceção
     */
    public function testUpdateRolesWithPermissions()
    {
        $this->createAuthenticatedSession(2);

        $payload = SELF::DATA[0];
        $id = $payload['id'];
        unset($payload['id']);

        $result = $this->withBody(json_encode($payload), 'application/json')->put("{$this->route}/$id");

        $result->assertJSONFragment([
            "success" => "Api.roles.success.put"
        ]);
        $result->assertStatus(ResponseInterface::HTTP_OK);
    }
}
