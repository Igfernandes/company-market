<?php

namespace Tests\Feature\Users\Roles\Permissions\Post;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Mocks\Users\RolesPermissionsMock;
use Tests\Support\Sessions\AuthenticatedSession;

class PostSuccessTest extends RolesPermissionsMock
{
    use FeatureTestTrait, AuthenticatedSession;

    private string $route = '/api/users/roles/{id}/permissions';

    /**
     * Cenário: payload inválido causa exceção
     */
    public function testUpdateRoles()
    {
        $this->createAuthenticatedSession(2);

        $payload = SELF::DATA[0];
        $id = $payload['role_id'];

        $result = $this
            ->withBody(json_encode($payload), 'application/json')
            ->post(str_replace("{id}", $id, $this->route));

        $result->assertJSONFragment([
            "success" => "Api.roles.permissions.success.post"
        ]);
        $result->assertStatus(ResponseInterface::HTTP_CREATED);
    }

    /**
     * Cenário: payload inválido causa exceção
     */
    public function testUpdateRolesWithPermissions()
    {
        $this->createAuthenticatedSession(2);

        $payload = SELF::DATA[0];
        $id = $payload['role_id'];

        $result = $this
            ->withBody(json_encode($payload), 'application/json')
            ->post(str_replace("{id}", $id, $this->route));

        $result->assertJSONFragment([
            "success" => "Api.roles.permissions.success.post"
        ]);
        $result->assertStatus(ResponseInterface::HTTP_CREATED);
    }
}
