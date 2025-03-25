<?php

namespace App\Api\Clients\Categories\Post;

use App\Business\Clients\CategoryBusiness;
use App\Database\Entities\Clients\CategoryEntity;
use App\Database\Entities\clients\ClientCategoryEntity;
use App\Database\Models\Clients\CategoriesModel;
use App\Database\Models\Clients\ClientsCategoriesModel;
use App\Libraries\Exceptions\Exceptions;

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

        $categoriesExclude = $categoriesBusiness->getCategoriesExclude($categories);
        $categoriesExcludeName = $categoriesBusiness->hasClientsRelations($categoriesExclude);

        if (count($categoriesExcludeName) > 0)
            throw new Exceptions(\str_replace("{categories}", \join(", ", $categoriesExcludeName), lang("Api.categories.alerts.has_clients")), BAD_BUSINESS_RULES);

        if (count($categoriesExclude) > 0)
            $categoriesModel->whereIn("name", \array_map(fn($category) => $category->getName(), $categoriesExclude))->delete();

        foreach ($categories as $position => $category) {

            $categoryEntity = new CategoryEntity();

            if (!isset($category->name) || empty($category->name))
                throw new Exceptions(\str_replace("{field}", "name",  lang("Validations.required")), BAD_BUSINESS_RULES);

            $categoryEntity->setName($category->name);
            $categoryEntity->setDescription(isset($category->description) ? $category->description : "");
            $categoryEntity->setPosition($position + 1);

            $categoriesModel->upsert($categoryEntity->toArray(true), $categoryEntity);
        }

        return (object)[
            "success" => lang("Api.categories.success.post")
        ];
    }
}
