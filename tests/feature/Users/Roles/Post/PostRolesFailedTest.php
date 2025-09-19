<?php

namespace Tests\Feature\Users\Roles\Post;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Mocks\Users\RolesMock;
use Tests\Support\Sessions\AuthenticatedSession;

class PostRolesFailedTest extends RolesMock
{
    use FeatureTestTrait, AuthenticatedSession;

    private string $route = '/api/users/roles';

    /**
     * Cenário: payload inválido causa exceção
     */
    public function testReturnErrorByIdIncorrect()
    {
        $this->createAuthenticatedSession(2);

        $payload = SELF::DATA[0];

        $result = $this->withBody(json_encode($payload), 'application/json')->post($this->route);

        $result->assertStatus(ResponseInterface::HTTP_NOT_ACCEPTABLE);
    }

    public function testReturnErroNotAvailableName()
    {
        $this->createAuthenticatedSession(1);

        $payload = SELF::DATA[0];
        $payload['name'] = null;

        $result = $this->withBody(json_encode($payload), 'application/json')->post($this->route);

        $result->assertJSONFragment([
            "error" => "Api.roles.invalid.name"
        ]);
        $result->assertStatus(ResponseInterface::HTTP_BAD_REQUEST);
    }

    public function testReturnErroNameEmpty()
    {
        $this->createAuthenticatedSession(1);

        $payload = SELF::DATA[0];
        $payload['name'] = null;

        $result = $this->withBody(json_encode($payload), 'application/json')->post($this->route);

        $result->assertJSONFragment([
            "error" => "Api.roles.invalid.name"
        ]);
        $result->assertStatus(ResponseInterface::HTTP_BAD_REQUEST);
    }

    public function testReturnErroNameGreaterThanHundred()
    {
        $this->createAuthenticatedSession(1);

        $payload = SELF::DATA[0];
        $payload['name'] = \str_repeat("AAA", 101);

        $result = $this->withBody(json_encode($payload), 'application/json')->post($this->route);

        $result->assertJSONFragment([
            "error" => "Api.roles.invalid.name"
        ]);
        $result->assertStatus(ResponseInterface::HTTP_BAD_REQUEST);
    }

    public function testReturnErroDescriptionGreaterThanThreeHundred()
    {
        $this->createAuthenticatedSession(1);

        $payload = SELF::DATA[0];
        $payload['description'] = \str_repeat("AAA", 401);

        $result = $this->withBody(json_encode($payload), 'application/json')->post($this->route);

        $result->assertJSONFragment([
            "error" => "Api.roles.invalid.description"
        ]);
        $result->assertStatus(ResponseInterface::HTTP_BAD_REQUEST);
    }
}
