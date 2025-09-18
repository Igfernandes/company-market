<?php

namespace Tests\Feature\Users\Roles\Get;

use App\Api\Operations\Notifications\Get\GetUseCases;
use App\Database\Models\Notifications\NotificationsModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Mocks\Users\RolesMock;
use Tests\Support\Sessions\AuthenticatedSession;

class GetRolesFailedTest extends RolesMock
{
    use FeatureTestTrait, AuthenticatedSession;

    private string $route = '/api/users/roles';

    /**
     * Cenário: payload inválido causa exceção
     */
    public function testInvalidRoleId()
    {
        $this->createAuthenticatedSession();
        $result = $this->call('get', "{$this->route}/0");

        $result->assertJSONFragment([]);
        $result->assertStatus(ResponseInterface::HTTP_NOT_FOUND);
    }

    /**
     * Cenário: payload inválido causa exceção
     */
    public function testInvalidName()
    {
        $this->createAuthenticatedSession();
        $result = $this->call('get', "{$this->route}/?name=" . \str_repeat("aaaa", 101));

        $result->assertJSONFragment([]);
        $result->assertStatus(ResponseInterface::HTTP_BAD_REQUEST);
    }

    public function testInvalidNameContains()
    {
        $this->createAuthenticatedSession();
        $result = $this->call('get', "{$this->route}/?name_contains=" . \str_repeat("aaaa", 101));

        $result->assertJSONFragment([]);
        $result->assertStatus(ResponseInterface::HTTP_BAD_REQUEST);
    }

    public function testInvalidDescriptionContains()
    {
        $this->createAuthenticatedSession();
        $result = $this->call('get', "{$this->route}/?description_contains=" . \str_repeat("aaaa", 101));

        $result->assertJSONFragment([]);
        $result->assertStatus(ResponseInterface::HTTP_BAD_REQUEST);
    }


    public function testInvalidStatus()
    {
        $this->createAuthenticatedSession();
        $result = $this->call('get', "{$this->route}/?status=none");

        $result->assertJSONFragment([]);
        $result->assertStatus(ResponseInterface::HTTP_BAD_REQUEST);
    }


    /**
     * Cenário: usuário possui permissões, mas nenhuma notificação encontrada
     */
    public function testNoRolesFound()
    {
        $this->createAuthenticatedSession();
        $modelMock = $this->createMock(NotificationsModel::class);
        $modelMock->method('getNotificationWithAuthor')->willReturn([]);

        $useCase = new GetUseCases();

        $result = $useCase->execute([
            'id' => 9999,
            'in_ids' => [9999],
            'author_id' => 999
        ]);

        $this->assertIsArray($result);
        $this->assertEmpty($result);
    }
}
