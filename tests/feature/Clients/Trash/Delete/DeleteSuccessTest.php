<?php

namespace Tests\Feature\Clients\Trash\Delete;

use App\Database\Models\Clients\ClientsModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Mocks\Clients\ClientsMock;
use Tests\Support\Sessions\AuthenticatedSession;

class DeleteSuccessTest extends ClientsMock
{
    use FeatureTestTrait, AuthenticatedSession;

    private string $route = '/api/clients/trash';

    /**
     * Cenário: payload inválido causa exceção
     */
    public function testDeleteClient()
    {
        $this->createAuthenticatedSession(1);

        $clientsModel = new ClientsModel();
        $client = $clientsModel->first();

        $result = $this->delete("{$this->route}/" . $client->getId());

        $result->assertJSONFragment([
            "success" => "Api.clients.trash.success.delete"
        ]);

        $found = $clientsModel->where("id", $client->getId())->first();

        $result->assertStatus(Response::HTTP_OK);
        $this->assertEmpty($found);
    }
}
