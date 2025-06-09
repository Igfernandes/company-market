<?php

namespace App\Services\Notifications;

use App\Database\Entities\Notifications\NotificationEntity;
use App\Database\Models\Notifications\NotificationsModel;
use App\Database\Models\Notifications\UsersNotificationsModel;

class NotificationsService
{
    protected $notificationsModel;
    protected $usersNotificationsModel;

    public function __construct()
    {
        $this->notificationsModel = new NotificationsModel();
        $this->usersNotificationsModel = new UsersNotificationsModel();
    }

    public function send(NotificationEntity $notification)
    {

        $this->notificationsModel->save($notification);

        // $PORT = getenv('websocket.port') ?: '8080';
        // $host = '127.0.0.1';

        // try {
        //     $client = new Client("ws://$host:$PORT?token-navigation={$props['tokenNavigation']}&channel={$props['channel']}");
        //     $client->send($props['message']);
        //     $client->close();
        //     echo "Mensagem enviada com sucesso\n";
        // } catch (\Exception $e) {
        //     echo "Erro no client websocket: " . $e->getMessage() . "\n";
        // }
    }
}
