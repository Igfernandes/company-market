<?php

namespace Tests\Feature\Companies\Delete;

use App\Database\Models\Companies\CompaniesModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Mocks\Companies\CompaniesMock;
use Tests\Support\Sessions\AuthenticatedSession;

class DeleteSuccessTest extends CompaniesMock
{
    use FeatureTestTrait, AuthenticatedSession;

    private string $route = '/api/companies';

    /**
     * Cenário: payload inválido causa exceção
     */
    public function testDeleteCompany()
    {
        $this->createAuthenticatedSession(1);

        $payload = SELF::DATA[0];
        $companiesModel = new CompaniesModel();
        $client = $companiesModel->where("name", $payload['name'])->first();

        $result = $this->delete("{$this->route}/" . $client->getId());

        $result->assertJSONFragment([
            "success" => "Api.companies.success.delete"
        ]);
        $result->assertStatus(Response::HTTP_OK);
    }
}
