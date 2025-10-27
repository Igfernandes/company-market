<?php

namespace Tests\Feature\Clients\Delete;

use App\Database\Models\Clients\ClientsModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Mocks\Clients\ClientsMock;
use Tests\Support\Sessions\AuthenticatedSession;

class DeleteSuccessTest extends ClientsMock
{
    use FeatureTestTrait, AuthenticatedSession;

    private string $route = '/api/clients';

    /**
     * Cenário: payload inválido causa exceção
     */
    public function testDeleteClient()
    {
        $this->createAuthenticatedSession(1);

        $payload = SELF::DATA[0];
        $clientsModel = new ClientsModel();
        $client = $clientsModel->where("name", $payload['name'])->first();

        $result = $this->delete("{$this->route}/" . $client->getId());

        $result->assertJSONFragment([
            "success" => "Api.clients.success.delete"
        ]);
        $result->assertStatus(Response::HTTP_OK);
    }
}
