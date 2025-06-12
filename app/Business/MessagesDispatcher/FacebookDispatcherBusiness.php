<?php

namespace App\Business\MessagesDispatcher;

use App\Business\Messages\MetaMessages;
use App\Database\Entities\MessagesDispatcher\MessageDispatcherEntity;
use App\Database\Entities\Reports\OperationFailureEntity;
use App\Database\Entities\Services\ServiceEntity;
use App\Database\Models\Services\ServicesModel;
use App\Libraries\Cerberus\Cerberus;
use App\Services\Meta\MetaService;

class FacebookDispatcherBusiness
{
    /**
     * @param MessageDispatcherEntity $messageDispatcherEntity
     */
    public function execute(MessageDispatcherEntity $messageDispatcherEntity)
    {
        helper('files');
        $metaService = new MetaService("FACEBOOK");

        if (!empty($messageDispatcherEntity->getServiceId())) {
            $servicesModel = new ServicesModel();

            /** @var ServiceEntity */
            $service = $servicesModel->where("id", $messageDispatcherEntity->getServiceId())->first();

            if (empty($service))
                return;

            $response = $metaService->postWithImage(MetaMessages::getServiceTemplate($service), \getPublicUrl($service->getPhoto()));
        } else {
            $response = $metaService->postSimple($messageDispatcherEntity->getContent());
        }

        // file_put_contents('webhook.log', "\n" . \json_encode($response), FILE_APPEND);
        if ($response['status'] !== OK) {
            $operationFailure = new OperationFailureEntity();

            $operationFailure->store([
                'operation_type'     => "Received PSID",
                'provider'           => "META",
                'error_code'         => $response['status'],
                'error_message'      => "Api.dispatchers.invalid.facebook_error",
                'response_received'  => \json_encode(isset($response['response']) ? $response['response'] : []),
                'payload_sent'       => \json_encode($messageDispatcherEntity->toArray(true)),
                'attempt_number'     => 0,
                'should_retry'       => true,
                'status'             => "PENDING",
            ]);
            Cerberus::report($operationFailure);
        }
    }
}
