<?php

namespace App\Api\Operations\Clients\Categories\Delete;

use App\Business\Clients\CategoryBusiness;
use App\Database\Models\Clients\CategoriesModel;
use App\Libraries\Exceptions\Exceptions;
use App\Services\Notifications\NotificationsService;
use CodeIgniter\HTTP\Response;

class DeleteUseCases
{
    /**
     * @param array{
     *   id: int
     * } $payload
     */
    public function execute(array $payload)
    {
        $categoriesModel = new CategoriesModel();
        $categoriesBusiness = new CategoryBusiness();

        $categoryId = $payload['id'];

        $found = $categoriesModel->where([
            "id" => $categoryId
        ])->first();

        if (empty($found))
            throw new Exceptions("Api.categories.invalid.not_found", Response::HTTP_NOT_ACCEPTABLE);

        if ($categoriesBusiness->hasClientsRelations($categoryId))
            throw new Exceptions("Api.categories.invalid.has_clients", Response::HTTP_NOT_ACCEPTABLE);

        $categoriesModel->delete($categoryId);

        NotificationsService::store([
            "scope" => "clients",
            "action" => "DELETE"
        ]);
        return (object)[
            "success" => "Api.categories.success.delete"
        ];
    }
}
