<?php

namespace App\Api\Services\Put;

use App\Database\Entities\Services\ServiceEntity;
use App\Database\Models\Services\ServicesModel;
use App\Libraries\Exceptions\Exceptions;
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
     *     type: 'APPELLANT'|'PUNCTUAL', 
     *     description_contains: string, 
     *     status: 'ACTIVE' | 'INACTIVE', 
     *     privacy: 'PUBLIC'|'PRIVATE',
     *     stock: integer,
     *     reservations: integer
     * } $payload
     */
    public function execute(array $payload)
    {
        $filteredPayload = \array_filter($payload, fn($field) => !empty($field));

        $servicesModel = new ServicesModel();
        $serviceEntity = new ServiceEntity();

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

            unlink($service->getPhoto());
        }
        unset($filteredPayload['photo']);

        $serviceEntity->store($filteredPayload);
        $serviceEntity->setName($filteredPayload['name']);
        $serviceEntity->setStatus(isset($filteredPayload['status']) ? $filteredPayload['status'] : "ACTIVE");
        $serviceEntity->setType($filteredPayload['type']);

        $serviceEntity->setStock(isset($filteredPayload['stock']) ? $filteredPayload['stock'] : 0);
        $serviceEntity->setReservations(isset($filteredPayload['reservations']) ? $filteredPayload['reservations'] : 0);

        $servicesModel->set($serviceEntity->toArray(true))->update($filteredPayload['id']);

        return (object)[
            "success" => lang("Api.services.success.put")
        ];
    }
}
