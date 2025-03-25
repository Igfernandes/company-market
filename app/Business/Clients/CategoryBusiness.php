<?php

namespace App\Business\Clients;

use App\Business\BaseBusiness;
use App\Database\Models\Clients\CategoriesModel;

class CategoryBusiness
{
    private CategoriesModel $categoriesModel;

    public function __construct()
    {
        $this->categoriesModel = new CategoriesModel();
    }

    use BaseBusiness;
    /**
     * @param int $payload
     */
    public function hasCategory($categoryId): bool
    {
        $foundCategory = $this->categoriesModel->where("id", $categoryId)->first();

        return !empty($foundCategory);
    }

    public function getCategoriesExclude($categories): array
    {
        $categoriesModel = new CategoriesModel();

        /** @var array{foundCategories:CategoryEntity} */
        $foundCategories = $categoriesModel->findAll();
        $excludeCategories = \array_filter($foundCategories, fn($category) => array_search($category->getName(), $categories) === false);

        return $excludeCategories;
    }

    public function hasClientsRelations(array $categoriesExclude): array
    {
        $categoriesModel = new CategoriesModel();

        if (count($categoriesExclude) == 0) return [];

        /** @var array{foundClientCategory:CategoryEntity} */
        $foundCategoriesRelationWithClient = $categoriesModel->join('clients_categories', 'categories.id = clients_categories.category_id')
            ->whereIn("name", array_map(fn($category) => $category->getName(), $categoriesExclude))->findAll();
        $categoriesExcludeName = [];

        foreach ($foundCategoriesRelationWithClient as $category) {
            $categoriesExcludeName[$category->getId()] = $category->getName();
        }

        return $categoriesExcludeName;
    }
}
