<?php

namespace App\Services\Notifications;

use App\Database\Models\Notifications\NotificationsModel;
use App\Database\Models\Notifications\UsersNotificationsModel;
use App\Libraries\HttpClient\HttpClient;

class NotificationsService
{
    protected $notificationsModel;
    protected $usersNotificationsModel;

    public function __construct()
    {
        $this->notificationsModel = new NotificationsModel();
        $this->usersNotificationsModel = new UsersNotificationsModel();
    }

    public static function store(array $notification)
    {
        $notificationsModel = new NotificationsModel();
        $session = \session();

        if (!isset($notification['author_id']) || empty($notification['author_id']))
            $notification['author_id'] = $session->get('userAuthId');

        $notificationsModel->save($notification);
        $URL_BASE = \getenv('globals.href.frontend');

        HttpClient::request("POST", "$URL_BASE/api/tasks/notifications", [
            'Content-Type' => 'application/json'
        ], [
            "token_navigation" => $session->get('tokenNavigation')
        ]);
    }
}
