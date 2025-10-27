<?php

namespace Tests\Feature\Clients\Put;

use App\Database\Models\Clients\CategoriesModel;
use App\Database\Models\Clients\ClientsModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Mocks\Clients\ClientsMock;
use Tests\Support\Sessions\AuthenticatedSession;

class PutSuccessTest extends ClientsMock
{
    use FeatureTestTrait, AuthenticatedSession;

    private string $route = '/api/clients';

    /**
     * Cenário: payload inválido causa exceção
     */
    public function testUpdateInformationById()
    {
        $this->createAuthenticatedSession(1);

        $payload = SELF::DATA[0];
        $categoriesModel = new  CategoriesModel();
        $category = $categoriesModel->first();

        $payload['category'] = $category->getId();

        $clientsModel = new ClientsModel();
        $client = $clientsModel->where("name", $payload['name'])->first();

        $result = $this->withBody(json_encode($payload), 'application/json')
            ->put("{$this->route}/{$client->getId()}");

        $result->assertJSONFragment([
            "success" => "Api.clients.success.put"
        ]);
        $result->assertStatus(Response::HTTP_OK);
    }
}
