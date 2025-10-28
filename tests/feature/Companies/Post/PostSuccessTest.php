<?php

namespace Tests\Feature\Companies\Post;

use CodeIgniter\HTTP\Response;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Mocks\Companies\CompaniesMock;
use Tests\Support\Sessions\AuthenticatedSession;

class PostSuccessTest extends CompaniesMock
{
    use FeatureTestTrait, AuthenticatedSession;

    private string $route = '/api/companies';

    /**
     * Cenário: payload inválido causa exceção
     */
    public function testUpdateUserInformationAuthenticated()
    {
        $this->createAuthenticatedSession(1);
        $payload = SELF::DATA[0];
        $payload['name'] = "New Company";
        $payload['phone'] = '5521851749851';

        $result = $this->withBody(json_encode($payload), 'application/json')
            ->post($this->route);

        $result->assertJSONFragment([
            "success" => "Api.companies.success.post"
        ]);
        $result->assertStatus(Response::HTTP_CREATED);
    }
}
