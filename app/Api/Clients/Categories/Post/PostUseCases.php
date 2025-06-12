<?php

namespace App\Api\Clients\Categories\Post;

use App\Business\Clients\CategoryBusiness;
use App\Database\Entities\Clients\CategoryEntity;
use App\Database\Models\Clients\CategoriesModel;
use App\Libraries\Exceptions\Exceptions;
use App\Services\Notifications\NotificationsService;

class PostUseCases
{
    /**
     * @param array{
     *   categories: array<object{
     *     name: string,
     *     description: string
     *   }>
     * } $payload
     */
    public function execute(array $payload)
    {
        $categoriesModel = new CategoriesModel();
        $categories = $payload['categories'];
        $categoriesBusiness = new CategoryBusiness();

        $categoriesExclude = $categoriesBusiness->getCategoriesExclude(array_map(fn($category) => $category->name, $categories));
        $categoriesAvailable = $categoriesBusiness->hasClientsRelations($categoriesExclude);

        if (count($categoriesAvailable) > 0)
            throw new Exceptions("Api.clients.categories.invalid.linked_category", BAD_BUSINESS_RULES);

        if (count($categoriesExclude) > 0)
            $categoriesModel->whereIn("name", \array_map(fn($category) => $category->getName(), $categoriesExclude))->delete();

        foreach ($categories as $position => $category) {

            $categoryEntity = new CategoryEntity();

            if (!isset($category->name) || empty($category->name))
                throw new Exceptions("Api.clients.categories.invalid.name", BAD_BUSINESS_RULES);

            $categoryEntity->setName($category->name);
            $categoryEntity->setDescription(isset($category->description) ? $category->description : "");
            $categoryEntity->setPosition($position + 1);

            $categoriesModel->upsert(["name" => $category->name], $categoryEntity);
        }

        NotificationsService::store([
            "scope" => "categories",
            "action" => "CREATE"
        ]);

        return [
            "success" => "Api.clients.categories.success.post"
        ];
    }
}
