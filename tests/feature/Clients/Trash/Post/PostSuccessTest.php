<?php

namespace Tests\Feature\Clients\Trash\Post;

use App\Database\Models\Clients\ClientsModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Mocks\Clients\ClientsMock;
use Tests\Support\Sessions\AuthenticatedSession;

class PostSuccessTest extends ClientsMock
{
    use FeatureTestTrait, AuthenticatedSession;

    private string $route = '/api/clients/trash';

    /**
     * Cenário: payload inválido causa exceção
     */
    public function testUpdateUserInformationAuthenticated()
    {
        $this->createAuthenticatedSession(1);
        $clientsModel = new ClientsModel();
        $foundClientIds = $clientsModel->findAll();

        $result = $this->withBody(json_encode([
            "in_ids" => \array_map(fn($boat) => $boat->getId(), $foundClientIds)
        ]), 'application/json')
            ->post($this->route);
        $result->assertJSONFragment([
            "success" => "Api.clients.trash.success.restore"
        ]);
        $result->assertStatus(Response::HTTP_OK);
    }
}
