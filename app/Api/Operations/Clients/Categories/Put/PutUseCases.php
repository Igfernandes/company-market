<?php

namespace App\Api\Operations\Clients\Categories\Put;

use App\Business\Clients\CategoryBusiness;
use App\Database\Entities\Clients\CategoryEntity;
use App\Database\Models\Clients\CategoriesModel;
use App\Libraries\Exceptions\Exceptions;
use CodeIgniter\HTTP\Response;

class PutUseCases
{
    /**
     * @param array{
     *   id: integer,
     *   name: string,
     *   description: string,
     * } $payload
     */
    public function execute(array $payload)
    {
        $categoryEntity = new CategoryEntity();
        $categoryEntity->store($payload);

        $categoriesModel = new CategoriesModel();
        $found = $categoriesModel->where("id", $payload['id'])->first();
        $categoriesBusiness = new CategoryBusiness();

        if ($categoriesBusiness->has([
            "name" => $payload['name']
        ],  $payload['id']))
            throw new Exceptions("Api.categories.invalid.already_exists_name",  Response::HTTP_NOT_ACCEPTABLE);

        if (empty($found))
            throw new Exceptions("Api.categories.invalid.id",  Response::HTTP_NOT_ACCEPTABLE);

        if (count($categoryEntity->toArray(true)) > 0)
            $categoriesModel->set($categoryEntity->toArray(true))->update($payload['id']);

        return (object)[
            "success" => "Api.categories.success.put"
        ];
    }
}
