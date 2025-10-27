<?php

namespace App\Api\Operations\Clients\Categories\Get;

use App\Database\Entities\Clients\CategoryEntity;
use App\Database\Models\Clients\CategoriesModel;
use App\Traits\BusinessTrait;

class GetUseCases
{
    use BusinessTrait;
    /**
     * @param array{
     *     id: int,
     *     in_ids: array<int>, 
     *     name: string, 
     *     name_contains: string,
     *     description: string, 
     *     description_contains: string,
     *     created_at: string, 
     *     updated_at: string 
     * } $payload
     */
    public function execute(array $payload)
    {
        $filteredPayload = \array_filter($payload, fn($field) => !empty($field));

        $categoriesModel = new CategoriesModel();
        $categoryEntity = new CategoryEntity();

        $in_ids = isset($filteredPayload['in_ids']) ? $filteredPayload['in_ids'] : [];
        unset($filteredPayload['in_ids']);

        $categoriesModel = $this->builderClauseWithContains($filteredPayload, $categoriesModel);

        if (count($in_ids) > 0)
            $categoriesModel->whereIn("id", $in_ids);

        $categoryEntity->store($filteredPayload);

        $limit = isset($payload['limit']) ? \intval($payload['limit']) : 50;
        $startIndexRegister = isset($payload['start']) ? \intval($payload['start']) : 0;

        /** @var array{CategoryEntity}*/
        $foundCategories = $categoriesModel->limit($limit, $startIndexRegister)->where($categoryEntity->toArray(true))->findAll();

        return array_map(fn(CategoryEntity $Category) => $Category->toArray(), $foundCategories);
    }
}
