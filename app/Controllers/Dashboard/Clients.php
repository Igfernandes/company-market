<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Database\Entities\Clients\CategoryEntity;
use App\Database\Models\Clients\CategoriesModel;
use App\Database\Models\Clients\ClientsCategoriesModel;
use App\Database\Models\Clients\ClientsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Clients extends BaseController
{

    public function index()
    {
        return view("layouts/dashboard/clients/index", []);
    }

    public function create()
    {
        $categoriesModel = new CategoriesModel();
        $categories = $categoriesModel->findAll();

        return view("layouts/dashboard/clients/forms", [
            "categories" => \array_map(fn(CategoryEntity $category) => [
                "text" => $category->getName(),
                "value" => $category->getId()
            ], $categories)
        ]);
    }

    public function form(int $clientId = 0)
    {
        $clientsModel = new ClientsModel();
        $found = $clientsModel->where([
            "id" => $clientId
        ])->first();

        if (empty($found))
            throw new PageNotFoundException();

        $categoriesModel = new CategoriesModel();
        $categories = $categoriesModel->findAll();

        $clientsCategoriesModel = new ClientsCategoriesModel();
        $categoriesUsed = $clientsCategoriesModel->where("client_id", $found->getId())->findAll();

        return view("layouts/dashboard/clients/forms", [
            "id" => $clientId,
            "client" => $found,
            "categories" => \array_map(fn(CategoryEntity $category) => [
                "text" => $category->getName(),
                "value" => $category->getId()
            ], $categories),
            "categoryId" => $categoriesUsed[0]->getCategoryId()
        ]);
    }

    public function trash()
    {
        return view("layouts/dashboard/clients/trash");
    }

    public function categories()
    {
        return view("layouts/dashboard/clients/categories");
    }
}
