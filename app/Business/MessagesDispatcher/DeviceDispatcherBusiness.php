<?php

namespace App\Business\MessagesDispatcher;

use App\Database\Entities\Finances\ChargeEntity;
use App\Database\Entities\MessagesDispatcher\MessageDispatcherEntity;
use App\Database\Entities\Services\ServiceEntity;
use App\Database\Models\Finances\ChargesModel;
use App\Database\Models\Services\ServicesModel;
use App\Services\DeviceNotifications\DeviceNotificationsService;

class DeviceDispatcherBusiness
{
    /**
     * @param array{int} $clientsId 
     * @param MessageDispatcherEntity $messageDispatcherEntity
     */
    public function execute(MessageDispatcherEntity $messageDispatcherEntity, array $clientsId)
    {
        $data = [
            "title" => $messageDispatcherEntity->getTitle()
        ];
        $serviceId = $messageDispatcherEntity->getServiceId();
        $chargeId = $messageDispatcherEntity->getChargeId();
        if (!empty($serviceId)) {
            $servicesModel = new ServicesModel();

            /** @var ServiceEntity */
            $service = $servicesModel->where("id", $serviceId)->first();

            $data['content'] =  $service->getDescription();
        } elseif (!empty($chargeId)) {
            $chargesModel = new ChargesModel();

            /** @var ChargeEntity */
            $charge = $chargesModel->where($chargeId)->first();

            $data['content'] =  $charge->getDescription();
        } else {
            $data = $messageDispatcherEntity->getContent();
        }

        $devicesNotification = new DeviceNotificationsService();

        $devicesNotification->handle($clientsId, $data);
    }
}
