<?php

namespace Tests\Support\Mocks\Clients;

use App\Business\Clients\ClientsBusiness;
use App\Database\Entities\Clients\CategoryEntity;
use App\Database\Entities\Clients\ClientEntity;
use App\Database\Models\Clients\CategoriesModel;
use App\Database\Models\Clients\ClientsModel;
use App\Database\Models\Companies\CompaniesModel;
use CodeIgniter\Test\CIUnitTestCase;
use Tests\Support\Mocks\Companies\CompaniesMock;

class ClientsMock extends CIUnitTestCase
{
    const DATA = [
        [
            'name' => 'Jessica Barmas',
            'avatar' => 'http://localhost/public/avatar.png',
            'phone' => '5521966033549',
            'email' => 'jessica@companymarket.com.br',
            'birthdate' => '25/12/1995',
            'status' => 'ACTIVE',
            'document' => '17225479621',
            'document_type' => 'CPF'
        ],
        [
            'name' => 'Eduardo Thomas',
            'avatar' => 'http://localhost/public/avatar.png',
            'phone' => '55219752033549',
            'email' => 'eduardo@companymarket.com.br',
            'birthdate' => '25/10/2000',
            'status' => 'ACTIVE',
            'document' => '172485479621',
            'document_type' => 'CPF'
        ]
    ];

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        CategoriesMock::setUpBeforeClass();
        CompaniesMock::setUpBeforeClass();
        $categoriesModel = new CategoriesModel();
        $companiesModel = new CompaniesModel();

        $company = $companiesModel->first();

        /** @var CategoryEntity */
        $category = $categoriesModel->first();

        $clientsBusiness = new ClientsBusiness();
        foreach (SELF::DATA as $data) {
            $data['category'] = $category->getId();
            $data['company_id'] = $company->getId();

            $clientsBusiness->store($data);
        }
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();

        $clientsModel  = new ClientsModel();
        $clientsModel->where("1=1")->delete(null, true);
    }
}
