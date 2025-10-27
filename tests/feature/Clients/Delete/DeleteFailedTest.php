<?php

namespace Tests\Feature\Clients\Delete;

use CodeIgniter\HTTP\Response;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Mocks\Clients\ClientsMock;
use Tests\Support\Sessions\AuthenticatedSession;

class DeleteFailedTest extends ClientsMock
{
    use FeatureTestTrait, AuthenticatedSession;

    private string $route = '/api/clients';

    public function testReturnErrorRoutNoAcceptStringsInPath()
    {
        $this->createAuthenticatedSession(1);

        $result = $this->delete("{$this->route}/none");
        $result->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
