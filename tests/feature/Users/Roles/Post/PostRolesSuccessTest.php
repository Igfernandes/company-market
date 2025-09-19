<?php

namespace Tests\Feature\Users\Roles\Post;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Mocks\Users\RolesMock;
use Tests\Support\Sessions\AuthenticatedSession;

class PostRolesSuccessTest extends RolesMock
{
    use FeatureTestTrait, AuthenticatedSession;

    private string $route = '/api/users/roles';

    /**
     * Cenário: payload inválido causa exceção
     */
    public function testCreateRoles()
    {
        $this->createAuthenticatedSession(1);

        $payload = SELF::DATA[0];
        unset($payload['permissions']);
        $payload['name'] = "Empresários";

        $result = $this->withBody(json_encode($payload), 'application/json')->post($this->route);

        $result->assertJSONFragment([
            "success" => "Api.roles.success.post"
        ]);
        $result->assertStatus(ResponseInterface::HTTP_CREATED);
    }

    /**
     * Cenário: payload inválido causa exceção
     */
    public function testCreateRolesWithPermissions()
    {
        $this->createAuthenticatedSession(1);

        $payload = SELF::DATA[0];
        $payload['name'] = "Médicos";

        $result = $this->withBody(json_encode($payload), 'application/json')->post($this->route);

        $result->assertJSONFragment([
            "success" => "Api.roles.success.post"
        ]);
        $result->assertStatus(ResponseInterface::HTTP_CREATED);
    }
}
