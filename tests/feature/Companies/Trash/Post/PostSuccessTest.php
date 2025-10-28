<?php

namespace Tests\Feature\Companies\Trash\Post;

use App\Database\Models\Companies\CompaniesModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Mocks\Companies\CompaniesMock;
use Tests\Support\Sessions\AuthenticatedSession;

class PostSuccessTest extends CompaniesMock
{
    use FeatureTestTrait, AuthenticatedSession;

    private string $route = '/api/companies/trash';

    /**
     * Cenário: payload inválido causa exceção
     */
    public function testUpdateUserInformationAuthenticated()
    {
        $this->createAuthenticatedSession(1);
        $companiesModel = new CompaniesModel();
        $foundIds = $companiesModel->findAll();

        $result = $this->withBody(json_encode([
            "in_ids" => \array_map(fn($boat) => $boat->getId(), $foundIds)
        ]), 'application/json')
            ->post($this->route);
        $result->assertJSONFragment([
            "success" => "Api.companies.trash.success.restore"
        ]);
        $result->assertStatus(Response::HTTP_OK);
    }
}
