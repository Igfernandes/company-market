<?php

namespace App\Business\Clients;

use App\Business\BaseBusiness;
use App\Database\Entities\Clients\CategoryEntity;
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
    public function has(array $query, int|null $id = null): CategoryEntity|null
    {
        $categoriesModel = new CategoriesModel();
        if (!empty($id))
            $categoriesModel->where("id !=", $id);

        $foundCategory = $categoriesModel->where($query)->first();

        return $foundCategory;
    }

    public function hasClientsRelations(int $categoryId): bool
    {
        $categoriesModel = new CategoriesModel();

        /** @var array{foundClientCategory:CategoryEntity} */
        $foundCategoriesRelationWithClient = $categoriesModel->join('clients_categories', 'categories.id = clients_categories.category_id')
            ->where("id", $categoryId)->findAll();

        return count($foundCategoriesRelationWithClient) > 0;
    }
}
