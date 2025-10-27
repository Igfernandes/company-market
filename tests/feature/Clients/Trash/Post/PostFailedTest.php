<?php

namespace Tests\Feature\Clients\Trash\Post;

use CodeIgniter\HTTP\Response;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Mocks\Clients\ClientsMock;
use Tests\Support\Sessions\AuthenticatedSession;

class PostFailedTest extends ClientsMock
{
    use FeatureTestTrait, AuthenticatedSession;

    private string $route = '/api/clients/trash';

    public function testMissingRequiredInIds()
    {
        $this->createAuthenticatedSession(1);
        $payload = [];

        $result = $this->withBody(json_encode($payload), 'application/json')
            ->post($this->route);

        $result->assertStatus(Response::HTTP_BAD_REQUEST);
        $result->assertJSONFragment(['error' => 'Api.clients.invalid.in_ids']);
    }

    public function testInIdsWithTypeInvalid()
    {
        $this->createAuthenticatedSession(1);
        $payload = [
            'in_ids' => ""
        ];

        $result = $this->withBody(json_encode($payload), 'application/json')
            ->post($this->route);

        $result->assertStatus(Response::HTTP_BAD_REQUEST);
        $result->assertJSONFragment(['error' => 'Api.clients.invalid.in_ids']);
    }
}
