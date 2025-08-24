<?php

namespace Tests\Feature\Users\Delete;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Mocks\Notifications\NotificationsMock;
use Tests\Support\Sessions\AuthenticatedSession;

class DeleteUsersFailedTest extends NotificationsMock
{
    use FeatureTestTrait, AuthenticatedSession;

    private string $route = '/api/users';
  

    public function testReturnErroNotFoundUser()
    {
        $this->createAuthenticatedSession(1);

        $result = $this->delete($this->route);

        $result->assertJSONFragment([
            "error" => "Api.invalid.route"
        ]);
        $result->assertStatus(ResponseInterface::HTTP_NOT_FOUND);
    }

     public function testReturnErrorRoutNoAcceptStringsInPath()
    {
        $this->createAuthenticatedSession(1);

        $result = $this->delete("{$this->route}/none");

        $result->assertStatus(ResponseInterface::HTTP_NOT_FOUND);
    }
}
