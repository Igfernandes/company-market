<?php

namespace App\Api\Services\Post;

use App\Business\Services\PhotoServiceBusiness;
use App\Database\Entities\Services\ServiceEntity;
use App\Database\Models\Services\ServicesModel;
use App\Traits\BusinessTrait;
use App\Traits\Services\ServicesDataTrait;
use CodeIgniter\HTTP\Files\UploadedFile;

class PostUseCases
{
    use ServicesDataTrait, BusinessTrait;

    /**
     * @param array{
     *     name: string, 
     *     photo: UploadedFile,
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

        $photoServiceBusiness = new PhotoServiceBusiness();
        $servicesModel = new ServicesModel();
        $serviceEntity = new ServiceEntity();

        if (isset($filteredPayload['photo'])) {
            $photo = $photoServiceBusiness->upload($filteredPayload['photo']);
            $serviceEntity->setPhoto($photo);
        }

        $serviceEntity->setName($filteredPayload['name']);
        $serviceEntity->setStatus(isset($filteredPayload['status']) ? $filteredPayload['status'] : "ACTIVE");
        $serviceEntity->setType($filteredPayload['type']);
        if (isset($filteredPayload['description']))
            $serviceEntity->setDescription($filteredPayload['description']);
        $serviceEntity->setPrivacy($filteredPayload['privacy']);
        $serviceEntity->setStock(isset($filteredPayload['stock']) ? $filteredPayload['stock'] : 0);
        $serviceEntity->setReservations(isset($filteredPayload['reservations']) ? $filteredPayload['reservations'] : 0);


        $servicesModel->save($serviceEntity);

        return (object)[
            "success" => lang("Api.services.success.post")
        ];
    }
}
