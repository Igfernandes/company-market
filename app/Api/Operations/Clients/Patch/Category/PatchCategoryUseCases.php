<?php

namespace App\Api\Operations\Clients\Patch\Category;

use App\Database\Models\Clients\CategoriesModel;
use App\Database\Models\Clients\ClientsCategoriesModel;
use App\Interfaces\IUseCases;
use App\Libraries\Exceptions\Exceptions;
use App\Services\Notifications\NotificationsService;

class PatchCategoryUseCases implements IUseCases
{
    /**
     * @param array{
     *   category: number,
     *   clients: array{integer}
     * } $payload
     */
    public function execute(array $payload): object
    {
        if (!isset($payload['clients']) || count($payload['clients']) == 0)
            throw new Exceptions('Api.clients.invalid.clients', BAD_BUSINESS_RULES);

        $clientsCategoriesModel = new ClientsCategoriesModel();
        $categoryModel = new CategoriesModel();

        $foundCategory = $categoryModel->where("id", $payload['category'])->first();

        if (empty($foundCategory))
            throw new Exceptions('Api.clients.invalid.category', BAD_BUSINESS_RULES);

        $clientsCategoriesModel->set("category_id", $payload['category'])->whereIn('client_id', $payload['clients'])->update();

        NotificationsService::store([
            "scope" => "clients",
            "action" => "UPDATE"
        ]);

        return (object)[
            "success" => "Api.clients.categories.success.patch"
        ];
    }
}
