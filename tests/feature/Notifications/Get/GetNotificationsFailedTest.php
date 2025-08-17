<?php

namespace Tests\Feature\Notifications\Get;

use App\Api\Operations\Notifications\Get\GetUseCases;
use App\Database\Models\Notifications\NotificationsModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Mocks\Notifications\NotificationsMock;
use Tests\Support\Sessions\AuthenticatedSession;

class GetNotificationsFailedTest extends NotificationsMock
{
    use FeatureTestTrait, AuthenticatedSession;

    private string $route = '/api/notifications';

    /**
     * Cenário: payload inválido causa exceção
     */
    public function testInvalidNotificationId()
    {
        $this->createAuthenticatedSession();
        $result = $this->call('get', "{$this->route}/0");

        $result->assertJSONFragment([]);
        $result->assertStatus(ResponseInterface::HTTP_OK);
    }

    /**
     * Cenário: payload inválido causa exceção
     */
    public function testInvalidNotificationInIds()
    {
        $this->createAuthenticatedSession();
        $result = $this->call('get', "{$this->route}/?in_ids[]=none");

        $result->assertJSONFragment([]);
        $result->assertStatus(ResponseInterface::HTTP_BAD_REQUEST);
    }

    /**
     * Cenário: payload inválido causa exceção
     */
    public function testInvalidNotificationAuthorId()
    {
        $this->createAuthenticatedSession();
        $result = $this->call('get', "{$this->route}/?author_id=none");

        $result->assertJSONFragment([]);
        $result->assertStatus(ResponseInterface::HTTP_BAD_REQUEST);
    }


    /**
     * Cenário: usuário possui permissões, mas nenhuma notificação encontrada
     */
    public function testNoNotificationsFound()
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
