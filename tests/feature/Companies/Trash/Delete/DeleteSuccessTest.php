<?php

namespace Tests\Feature\Companies\Trash\Delete;

use App\Database\Models\Companies\CompaniesModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Mocks\Companies\CompaniesMock;
use Tests\Support\Sessions\AuthenticatedSession;

class DeleteSuccessTest extends CompaniesMock
{
    use FeatureTestTrait, AuthenticatedSession;

    private string $route = '/api/companies/trash';

    /**
     * Cenário: payload inválido causa exceção
     */
    public function testDeleteCompany()
    {
        $this->createAuthenticatedSession(1);

        $companiesModel = new CompaniesModel();
        $company = $companiesModel->first();

        $result = $this->delete("{$this->route}/" . $company->getId());

        $result->assertJSONFragment([
            "success" => "Api.companies.trash.success.delete"
        ]);

        $found = $companiesModel->where("id", $company->getId())->first();

        $result->assertStatus(Response::HTTP_OK);
        $this->assertEmpty($found);
    }
}
