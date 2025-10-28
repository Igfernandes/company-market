<?php

namespace Tests\Feature\Companies\Trash\Post;

use CodeIgniter\HTTP\Response;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Mocks\Companies\CompaniesMock;
use Tests\Support\Sessions\AuthenticatedSession;

class PostFailedTest extends CompaniesMock
{
    use FeatureTestTrait, AuthenticatedSession;

    private string $route = '/api/companies/trash';

    public function testMissingRequiredInIds()
    {
        $this->createAuthenticatedSession(1);
        $payload = [];

        $result = $this->withBody(json_encode($payload), 'application/json')
            ->post($this->route);

        $result->assertStatus(Response::HTTP_BAD_REQUEST);
        $result->assertJSONFragment(['error' => 'Api.companies.invalid.in_ids']);
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
        $result->assertJSONFragment(['error' => 'Api.companies.invalid.in_ids']);
    }
}
