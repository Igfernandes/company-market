<?php

namespace App\Business\WebHooks;

use App\Business\Messages\MetaMessages;
use App\Database\Entities\Finances\ChargeEntity;
use App\Database\Entities\MessagesDispatcher\ClientMessageDispatcherEntity;
use App\Database\Entities\Services\ServiceEntity;
use App\Database\Models\Finances\ChargesModel;
use App\Database\Models\MessagesDispatcher\ClientsMessagesDispatcherModel;
use App\Database\Models\Services\ServicesModel;
use App\Services\WhatsApp\WhatsAppService;

class WhatsAppBusiness
{
    public function handleSend(array $clientsMessages)
    {
        helper(["files"]);

        if (!is_array($clientsMessages))
            return;

        $clientsMessagesDispatcherModel = new ClientsMessagesDispatcherModel();
        $whatsAppService = new WhatsAppService();
        $relationIds = $this->getRelationIds($clientsMessages);

        $servicesModel = new ServicesModel();
        $services = count($relationIds['serviceIds']) > 0 ? $servicesModel->whereIn("id", $relationIds['serviceIds'])->findAll() : $relationIds['serviceIds'];

        $chargesModel = new ChargesModel();
        $charges = \count($relationIds['chargeIds']) > 0 ? $chargesModel->whereIn("id", $relationIds['chargeIds'])->findAll() : [];

        /** @var ClientMessageDispatcherEntity */
        foreach ($clientsMessages as $clientMessage) {
            $message = $clientMessage->getMessage();

            $relationServiceId = $message->getServiceId();
            $relationChargeId = $message->getChargeId();
            $image = "";

            $content = $message->getContent();
            if (!empty($relationServiceId)) {
                $service = array_values(array_filter($services, fn(ServiceEntity $service) => $service->getId() === $relationServiceId));
                $content =  MetaMessages::getServiceToClientsTemplate($clientMessage->getClient(), $service[0]);
                $image = getPublicUrl($service[0]->getPhoto());
            } elseif (!empty($relationCharge)) {
                $charge = array_values(array_filter($charges, fn(ChargeEntity $charge) => $charge->getId() === $relationChargeId));
                $content =  MetaMessages::getChargeTemplate($clientMessage->getClient(), $charge[0]);
            } else if (empty($content))
                continue;

            $isSuccess = $whatsAppService->send($clientMessage->getClient(), $content, $image);

            if ($isSuccess)
                $clientsMessagesDispatcherModel->set("status", "SUCCESSFUL")->where([
                    "client_id" => $clientMessage->getClientId(),
                    "message_id" => $clientMessage->getMessageId()
                ])->update();
        }
    }

    public function getRelationIds(array $clientsMessages)
    {
        $serviceIds = [];
        $chargeIds = [];

        /** @var ClientMessageDispatcherEntity */
        foreach ($clientsMessages as $clientMessage) {
            $message = $clientMessage->getMessage();

            if (!empty($message->getServiceId()))
                \array_push($serviceIds, $message->getServiceId());

            if (!empty($message->getChargeId()))
                \array_push($chargeIds, $message->getChargeId());
        };

        return [
            "serviceIds" => $serviceIds,
            "chargeIds" => $chargeIds
        ];
    }
}
