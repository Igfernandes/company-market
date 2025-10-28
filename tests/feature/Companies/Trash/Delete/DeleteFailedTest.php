<?php

namespace Tests\Feature\Companies\Trash\Delete;

use CodeIgniter\HTTP\Response;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Mocks\Companies\CompaniesMock;
use Tests\Support\Sessions\AuthenticatedSession;

class DeleteFailedTest extends CompaniesMock
{
    use FeatureTestTrait, AuthenticatedSession;

    private string $route = '/api/companies/trash';
  

    public function testReturnErroNotFoundBoat()
    {
        $this->createAuthenticatedSession(1);

        $result = $this->delete($this->route);

        $result->assertJSONFragment([
            "error" => "Api.invalid.route"
        ]);
        $result->assertStatus(Response::HTTP_NOT_FOUND);
    }

     public function testReturnErrorRoutNoAcceptStringsInPath()
    {
        $this->createAuthenticatedSession(1);

        $result = $this->delete("{$this->route}/none");

        $result->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
