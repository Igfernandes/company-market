<?php

namespace Tests\Feature\Clients\Post;

use App\Database\Models\Clients\CategoriesModel;
use App\Database\Models\Companies\CompaniesModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Mocks\Clients\ClientsMock;
use Tests\Support\Sessions\AuthenticatedSession;

class PostSuccessTest extends ClientsMock
{
    use FeatureTestTrait, AuthenticatedSession;

    private string $route = '/api/clients';

    /**
     * Cenário: payload inválido causa exceção
     */
    public function testUpdateUserInformationAuthenticated()
    {
        $this->createAuthenticatedSession(1);
        $payload = SELF::DATA[0];
        $payload['name'] = "New Client";
        $payload['phone'] = '5521851749851';

        $categoriesModel = new  CategoriesModel();
        $category = $categoriesModel->first();

        $payload['category'] = $category->getId();

        $companiesModel = new  CompaniesModel();
        $company = $companiesModel->first();

        $payload['company'] = $company->getId();

        $result = $this->withBody(json_encode($payload), 'application/json')
            ->post($this->route);
        $result->assertJSONFragment([
            "success" => "Api.clients.success.post"
        ]);
        $result->assertStatus(Response::HTTP_CREATED);
    }
}
