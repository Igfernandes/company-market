<?php

namespace App\Api\Operations\Clients\Categories\Post;

use App\Business\Clients\CategoryBusiness;
use App\Database\Entities\Clients\CategoryEntity;
use App\Database\Models\Clients\CategoriesModel;
use App\Services\Notifications\NotificationsService;
use CodeIgniter\HTTP\Response;
use Exception;

class PostUseCases
{
    /**
     * @param array{
     *   name: string,
     *   description: string
     * } $payload
     */
    public function execute(array $payload)
    {
        $categoriesModel = new CategoriesModel();
        $categoriesBusiness = new CategoryBusiness();

        if ($categoriesBusiness->has([
            "name" => $payload['name']
        ]))
            throw new Exception("Api.categories.invalid.name", Response::HTTP_NOT_ACCEPTABLE);

        $categoryEntity = new CategoryEntity();
        $categoryEntity->store($payload);

        $categoriesModel->insert($categoryEntity);

        NotificationsService::store([
            "scope" => "categories",
            "action" => "CREATE"
        ]);

        return [
            "success" => "Api.categories.success.post"
        ];
    }
}
