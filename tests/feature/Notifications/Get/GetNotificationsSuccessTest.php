<?php

namespace Tests\Feature\Notifications\Get;

use App\Api\Operations\Notifications\Get\GetUseCases;
use App\Database\Models\Notifications\NotificationsModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Mocks\Notifications\NotificationsMock;
use Tests\Support\Sessions\AuthenticatedSession;

class GetNotificationsSuccessTest extends NotificationsMock
{
    use FeatureTestTrait, AuthenticatedSession;

    private string $route = '/api/notifications';

    /**
     * Cenário: payload vazio
     */
    public function testPayloadEmpty()
    {
        $this->createAuthenticatedSession();
        $result = $this->call('get', $this->route);

        $result->assertStatus(ResponseInterface::HTTP_OK);
    }


    /**
     * Cenário: sucesso com uma notificação
     */
    public function testSuccessWithNotification()
    {
        $this->createAuthenticatedSession();

        $notificationsModel = new NotificationsModel();

        $notification = $notificationsModel->first();
        $notificationId = $notification->getId();

        $useCase = new GetUseCases();
        $result = $useCase->execute([
            'id' => $notificationId,
            'in_ids' => [$notificationId],
            'author_id' => 1
        ]);

        $this->assertIsArray($result);
        $this->assertEquals($notification->getTitle(), $result[0]->title);
        $this->assertEquals($notification->getMessage(), $result[0]->message);
    }

    /**
     * Cenário: várias notificações retornadas
     */
    public function testMultipleNotifications()
    {
        $this->createAuthenticatedSession();
        $notificationsModel = new NotificationsModel();

        $notifications = $notificationsModel->whereIn("scope", ["charges", "clients"])->findAll();
        $notificationFirst = $notifications[0];
        $notificationSecond = $notifications[1];

        $useCase = new GetUseCases();
        $result = $useCase->execute([
            'in_ids' => [
                $notificationFirst->getId(),
                $notificationSecond->getId()
            ],
        ]);

        $this->assertCount(2, $result);
    }

    /**
     * Cenário: usuário com permissões específicas
     */
    public function testUserWithSpecificPermissions()
    {
        $this->createAuthenticatedSession();

        $useCase = new GetUseCases();
        $result = $useCase->execute([
            'id' => 1,
            'author_id' => 1,
        ]);

        $this->assertIsArray($result);
    }
}
