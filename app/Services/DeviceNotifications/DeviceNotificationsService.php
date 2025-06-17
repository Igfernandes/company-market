<?php

namespace App\Services\DeviceNotifications;

use App\Database\Entities\Reports\OperationFailureEntity;
use App\Database\Entities\Subscribes\SubscribeEntity;
use App\Database\Models\Subscribes\SubscribesModel;
use App\Libraries\Cerberus\Cerberus;
use Exception;
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

class DeviceNotificationsService
{
    private WebPush $webPush;

    public function __construct()
    {
        $email = getenv('globals.admin.login');
        $this->webPush = new WebPush([
            'VAPID' => [
                'subject' => "mailto:$email",
                'publicKey' => getenv('private.push_notification.public_key'),
                'privateKey' => getenv('private.push_notification.private_key'),
            ],
        ]);
    }

    /**
     * @param array{int} $clientIds
     * @param array{
     *     title: string,
     *     content: string
     * } $notification
     */
    public function handle(array $clientIds, array $notification)
    {
        try {
            $subscribesModel = new SubscribesModel();
            $subscribes =  $subscribesModel->select('subscribes.*')
                ->join("clients", "clients.phone_sha256 = subscribes.phone_sha256")
                ->whereIn("clients.id", $clientIds)
                ->findAll();

            /** @var SubscribeEntity */
            foreach ($subscribes as $subscribe) {
                $data = json_decode($subscribe->getData());
                $subscription = Subscription::create([
                    'endpoint' => json_decode($data['endpoint'], true),
                    'keys' => json_decode($data['keys'], true),
                ]);

                $this->webPush->queueNotification(
                    $subscription,
                    json_encode(['title' => $notification['title'], 'body' => $notification['content']])
                );
            }

            foreach ($this->webPush->flush() as $report) {
                if ($report->isSuccess())
                    continue;

                $operationFailure = new OperationFailureEntity();
                $operationFailure->store([
                    'operation_type'     => "SEND_DEVICE_NOTIFICATION",
                    'provider'           => "DEVICE_NOTIFICATION",
                    'error_code'         => \BAD_REQUEST,
                    'error_message'      => "Api.dispatchers.invalid.device_notification",
                    'response_received'  => \json_encode(isset($report) ? $report : []),
                    'payload_sent'       => \json_encode([
                        "client_id" =>  $clientIds
                    ]),
                    'attempt_number'     => 0,
                    'should_retry'       => true,
                    'status'             => "PENDING",
                ]);
                Cerberus::report($operationFailure);
            }
        } catch (Exception $err) {
        }
    }
}
