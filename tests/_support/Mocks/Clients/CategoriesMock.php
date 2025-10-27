<?php

namespace Tests\Support\Mocks\Clients;

use App\Database\Models\Clients\CategoriesModel;
use App\Database\Models\Clients\ClientsModel;
use CodeIgniter\Test\CIUnitTestCase;

class CategoriesMock extends CIUnitTestCase
{
    const DATA = [
        [
            'id' => 1, // id inexistente
            'name' => 'Rio de Janeiro',
            'description' => "Estado do Brasil"
        ],
        [
            'id' => 2, // id inexistente
            'name' => 'São Paulo',
            'description' => "Estado do Brasil"
        ]
    ];

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        $categoriesModel = new CategoriesModel();
        foreach (SELF::DATA as $data) {
            $category = $categoriesModel->where("name", $data['name'])->first();

            if (!empty($category))
                continue;

            $categoriesModel->insert($data);
        }
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();

        $categoriesModel  = new CategoriesModel();
        $categoriesModel->where("1=1")->delete(null, true);
    }
}
