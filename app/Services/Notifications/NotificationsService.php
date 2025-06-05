<?php

namespace App\Services\Notifications;

use App\Database\Models\Notifications\ClientsNotificationsModel;
use App\Database\Models\Notifications\NotificationsModel;

class NotificationService
{
    protected $notificationsModel;
    protected $clientsNotificationsModel;

    public function __construct()
    {
        $this->notificationsModel = new NotificationsModel();
        $this->clientsNotificationsModel = new ClientsNotificationsModel();
    }

    public function processScheduledNotifications(): void
    {
        $notifications = $this->notificationsModel->getScheduledToRunNow();

        foreach ($notifications as $notification) {
            $clients = $this->clientsNotificationsModel
                ->where('notification_id', $notification->id)
                ->pending()
                ->findAll();

            foreach ($clients as $clientNotification) {
                // Simula envio para cada plataforma
                $success = $this->sendToPlatform($clientNotification);

                $clientNotification->status = $success ? 'SUCCESSFUL' : 'BLOCKED';
                $clientNotification->log_error = $success ? null : 'Falha no envio simulado.';
                $this->clientsNotificationsModel->save($clientNotification);
            }
        }
    }

    protected function sendToPlatform($clientNotification): bool
    {
        // Aqui você pode integrar com APIs (Twilio, Meta, WhatsApp Cloud, etc.)
        // Simulação de sucesso para fins de exemplo
        return true;
    }
}
