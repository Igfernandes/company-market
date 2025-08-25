<?php

namespace Tests\Trait;

use PHPUnit\Framework\TestCase;
use App\Traits\Notifications\NotificationsDataTrait;
use App\Database\Entities\Notifications\NotificationEntity;
use App\Database\Entities\Users\UserEntity;
use Tests\Support\Sessions\AuthenticatedSession;

class NotificationsDataTraitTest extends TestCase
{
    use NotificationsDataTrait, AuthenticatedSession;

    public function testNotificationsResponse()
    {
        // Mock do Author
        $this->createAuthenticatedSession();
        $userEntity = new UserEntity();

        $author = [
            "id" => 1,
            "name" => "admin"
        ];
        $userEntity->store($author);

        // Mock da NotificationEntity
        $notificationMock = $this->createMock(NotificationEntity::class);
        $notificationMock->method('getId')->willReturn(1);
        $notificationMock->method('getTitle')->willReturn('Título de teste');
        $notificationMock->method('getMessage')->willReturn('Mensagem de teste');
        $notificationMock->method('getScope')->willReturn('clients');
        $notificationMock->method('getAction')->willReturn('CREATE');
        $notificationMock->method('getKey')->willReturn(1);
        $notificationMock->method('getAuthor')->willReturn($userEntity);
        $notificationMock->method('getCreatedAt')->willReturn('2025-08-16 14:05:35');

        $result = $this->notificationsResponse($notificationMock);

        $expected = (object)[
            'id' => 1,
            'title' => 'Título de teste',
            'message' => 'Mensagem de teste',
            'operation' => 'clients_create',
            'key' => 1,
            'author' => (object)$author,
            'created_at' => '2025-08-16 14:05:35'
        ];

        $this->assertEquals($expected, $result);
    }
}
