<?php

namespace Tests\Feature\Invites\Post;

use App\Database\Models\Invites\InvitesModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Mocks\Notifications\NotificationsMock;
use Tests\Support\Sessions\AuthenticatedSession;

class PostInvitesFailedTest extends NotificationsMock
{
    use FeatureTestTrait, AuthenticatedSession;

    private string $route = '/api/invites/user';
    const PAYLOAD =  [
        'name' => 'Teste',
        'email' => 'teste@example.com'
    ];
    
    /**
     * Cenário: payload inválido causa exceção
     */
    public function testReturnErrorByNameEmpty()
    {
        $this->createAuthenticatedSession(2);

        $payload = SELF::PAYLOAD;
        unset($payload['name']);

        $result = $this->withBody(json_encode($payload), 'application/json')->post($this->route);

        $result->assertJSONFragment([
            "error" => "Api.invites.invalid.name"
        ]);
        $result->assertStatus(ResponseInterface::HTTP_BAD_REQUEST);
    }
    /**
     * Cenário: payload inválido causa exceção
     */
    public function testReturnErrorByNameLessThanThree()
    {
        $this->createAuthenticatedSession(2);

        $payload = SELF::PAYLOAD;
        $payload['name'] = 1;

        $result = $this->withBody(json_encode($payload), 'application/json')->post($this->route);

        $result->assertJSONFragment([
            "error" => "Api.invites.invalid.name"
        ]);
        $result->assertStatus(ResponseInterface::HTTP_BAD_REQUEST);
    }
    /**
     * Cenário: payload inválido causa exceção
     */
    public function testReturnErrorByNameGreaterThanHundred()
    {
        $this->createAuthenticatedSession(2);

        $payload = SELF::PAYLOAD;
        $payload['name'] = \str_repeat("Nome", 101);

        $result = $this->withBody(json_encode($payload), 'application/json')->post($this->route);

        $result->assertJSONFragment([
            "error" => "Api.invites.invalid.name"
        ]);
        $result->assertStatus(ResponseInterface::HTTP_BAD_REQUEST);
    }

    public function testReturnErrorByEmailEmpty()
    {
        $this->createAuthenticatedSession(2);

        $payload = SELF::PAYLOAD;
        unset($payload['email']);

        $result = $this->post($this->route, $payload);

        $result->assertJSONFragment([
            "error" => "Api.invites.invalid.email"
        ]);
        $result->assertStatus(ResponseInterface::HTTP_BAD_REQUEST);
    }

    /**
     * Cenário: payload inválido causa exceção
     */
    public function testReturnErrorIsInvalidEmail()
    {
        $this->createAuthenticatedSession(2);

        $payload = SELF::PAYLOAD;
        $payload['email'] = "invalidEmail";

        $result = $this->post($this->route, $payload);

        $result->assertJSONFragment([
            "error" => "Api.invites.invalid.email"
        ]);
        $result->assertStatus(ResponseInterface::HTTP_BAD_REQUEST);
    }
    /**
     * Cenário: payload inválido causa exceção
     */
    public function testReturnErrorByEmailGreaterThanAllowed()
    {
        $this->createAuthenticatedSession(2);

        $payload = SELF::PAYLOAD;
        $payload['email'] = \str_repeat("none", 250) . $payload['email'];

        $result = $this->post($this->route, $payload);

        $result->assertJSONFragment([
            "error" => "Api.invites.invalid.email"
        ]);
        $result->assertStatus(ResponseInterface::HTTP_BAD_REQUEST);
    }
}
