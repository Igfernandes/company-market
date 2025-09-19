<?php

namespace Tests\Feature\Users\Roles\Permissions\Post;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Mocks\Users\RolesPermissionsMock;
use Tests\Support\Sessions\AuthenticatedSession;

class PostFailedTest extends RolesPermissionsMock
{
    use FeatureTestTrait, AuthenticatedSession;

    private string $route = '/api/users/roles/0/permissions';

    /**
     * Cenário: payload inválido causa exceção
     */
    public function testReturnErrorEmptyRoleId()
    {
        $this->createAuthenticatedSession(2);

        $payload = SELF::DATA[0];
        $payload['role_id'] = null;

        $result = $this->withBody(json_encode($payload), 'application/json')->post($this->route);

        $result->assertJSONFragment([
            "error" => "Api.roles.invalid.id"
        ]);
        $result->assertStatus(ResponseInterface::HTTP_BAD_REQUEST);
    }

    public function testReturnErrorEmptyIds()
    {
        $this->createAuthenticatedSession(1);

        $payload = SELF::DATA[0];
        $payload['ids'] = null;

        $result = $this->withBody(json_encode($payload), 'application/json')->post($this->route);

        $result->assertJSONFragment([
            "error" => "Api.roles.invalid.permissions"
        ]);
        $result->assertStatus(ResponseInterface::HTTP_BAD_REQUEST);
    }
}
