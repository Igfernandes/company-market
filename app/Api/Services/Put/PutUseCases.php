<?php

namespace App\Api\Services\Put;

use App\Business\Services\ServicesRulesBusiness;
use App\Database\Entities\Services\ServiceEntity;
use App\Database\Models\Services\ServicesModel;
use App\Libraries\Exceptions\Exceptions;
use App\Services\Notifications\NotificationsService;
use App\Traits\BusinessTrait;
use App\Traits\Services\ServicesDataTrait;
use stdClass;

class PutUseCases
{
    use ServicesDataTrait, BusinessTrait;

    /**
     * @param array{
     *     id: integer,
     *     name: string, 
     *     photo: stdClass,
     *     description_contains: string, 
     *     status: 'ACTIVE' | 'INACTIVE', 
     *     stock: integer,
     *     realized_at: string,
     *     expired_at: string,
     *     gratuity: integer
     * } $payload
     */
    public function execute(array $payload)
    {
        $filteredPayload = \array_filter($payload, fn($field) => !empty($field));

        $servicesModel = new ServicesModel();
        $serviceEntity = new ServiceEntity();

        $foundService = $servicesModel->where("id", $filteredPayload['id'])->first();

        if (empty($foundService))
            throw new Exceptions("Api.services.invalid.not_found");

        if (isset($filteredPayload['photo'])) {
            if (isset($filteredPayload['photo']->base64)) {
                $idFile = uniqid("preview-service-") . date("Y-m-d-H-S");
                $photo = saveBase64ToUploads($filteredPayload['photo']->base64,  $idFile);
                $serviceEntity->setPhoto($photo);
            }
        } else {
            $serviceEntity->setPhoto('');
            /** @var ServiceEntity */
            $service = $servicesModel->where("id", $filteredPayload['id'])->first();

            if (!empty($service->getPhoto()))
                unlink($service->getPhoto());
        }
        unset($filteredPayload['photo']);

        $serviceEntity->store($filteredPayload);
        $serviceEntity->setName($filteredPayload['name']);
        $serviceEntity->setStatus(isset($filteredPayload['status']) ? $filteredPayload['status'] : "ACTIVE");

        $serviceEntity->setStock(isset($filteredPayload['stock']) ? $filteredPayload['stock'] : 0);

        $servicesModel->set($serviceEntity->toArray(true))->update($filteredPayload['id']);

        $servicesRulesBusiness = new ServicesRulesBusiness();
        if (isset($filteredPayload['gratuity']))
            $servicesRulesBusiness->gratuity($filteredPayload['id'], $filteredPayload['gratuity']);

        NotificationsService::store([
            "scope" => "services",
            "action" => "UPDATE",
            "key" => $filteredPayload['id']
        ]);
        return (object)[
            "success" => "Api.services.success.put"
        ];
    }
}
