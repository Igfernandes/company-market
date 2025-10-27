<?php

namespace Tests\Feature\Companies\Put;

use App\Database\Models\Companies\CompaniesModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Mocks\Companies\CompaniesMock;
use Tests\Support\Sessions\AuthenticatedSession;

class PutSuccessTest extends CompaniesMock
{
    use FeatureTestTrait, AuthenticatedSession;

    private string $route = '/api/companies';

    /**
     * Cenário: payload inválido causa exceção
     */
    public function testUpdateInformationById()
    {
        $this->createAuthenticatedSession(1);

        $payload = SELF::DATA[0];

        $companiesModel = new CompaniesModel();
        $company = $companiesModel->where("name", $payload['name'])->first();

        $result = $this->withBody(json_encode($payload), 'application/json')
            ->put("{$this->route}/{$company->getId()}");

        $result->assertJSONFragment([
            "success" => "Api.companies.success.put"
        ]);
        $result->assertStatus(Response::HTTP_OK);
    }
}
