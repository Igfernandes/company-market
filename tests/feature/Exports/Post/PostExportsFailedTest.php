<?php

namespace Tests\Feature\Invites\Post;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Mocks\Notifications\NotificationsMock;
use Tests\Support\Sessions\AuthenticatedSession;

class PostExportsFailedTest extends NotificationsMock
{
    use FeatureTestTrait, AuthenticatedSession;

    private string $route = '/api/exports';
    const PAYLOAD =  [
        'entity' => 'USERS',
        'type' => 'EXCEL',
        'in_ids' => [1]
    ];

    /**
     * Cenário: payload inválido causa exceção
     */
    public function testReturnErrorByEntityEmpty()
    {
        $this->createAuthenticatedSession(1);

        $payload = SELF::PAYLOAD;
        unset($payload['entity']);

        $result = $this->withBody(json_encode($payload), 'application/json')->post($this->route);

        $result->assertJSONFragment([
            "error" => "Api.exports.invalid.entity"
        ]);
        $result->assertStatus(ResponseInterface::HTTP_BAD_REQUEST);
    }


    /**
     * Cenário: payload inválido causa exceção
     */
    public function testReturnErrorEntityInvalid()
    {
        $this->createAuthenticatedSession(1);

        $payload = SELF::PAYLOAD;
        $payload['entity'] = "NONES";

        $result = $this->withBody(json_encode($payload), 'application/json')->post($this->route);

        $result->assertJSONFragment([
            "error" => "Api.exports.invalid.entity"
        ]);
        $result->assertStatus(ResponseInterface::HTTP_NOT_ACCEPTABLE);
    }


    /**
     * Cenário: payload inválido causa exceção
     */
    public function testReturnErrorByTypeEmpty()
    {
        $this->createAuthenticatedSession(1);

        $payload = SELF::PAYLOAD;
        unset($payload['type']);

        $result = $this->withBody(json_encode($payload), 'application/json')->post($this->route);

        $result->assertJSONFragment([
            "error" => "Api.exports.invalid.type"
        ]);
        $result->assertStatus(ResponseInterface::HTTP_BAD_REQUEST);
    }

    /**
     * Cenário: payload inválido causa exceção
     */
    public function testReturnErrorByTypeInvalid()
    {
        $this->createAuthenticatedSession(1);

        $payload = SELF::PAYLOAD;
        $payload['type'] = "none";

        $result = $this->withBody(json_encode($payload), 'application/json')->post($this->route);

        $result->assertJSONFragment([
            "error" => "Api.exports.invalid.type"
        ]);
        $result->assertStatus(ResponseInterface::HTTP_BAD_REQUEST);
    }

    /**
     * Cenário: payload inválido causa exceção
     */
    public function testReturnErrorInIdsIsNotArray()
    {
        $this->createAuthenticatedSession(1);

        $payload = SELF::PAYLOAD;
        $payload['in_ids'] = "none";

        $result = $this->withBody(json_encode($payload), 'application/json')->post($this->route);

        $result->assertJSONFragment([
            "error" => "Api.exports.invalid.in_ids"
        ]);
        $result->assertStatus(ResponseInterface::HTTP_BAD_REQUEST);
    }
}
