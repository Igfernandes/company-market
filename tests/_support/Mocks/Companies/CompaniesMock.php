<?php

namespace Tests\Support\Mocks\Companies;

use App\Business\Companies\CompaniesBusiness;
use App\Database\Models\Clients\ClientsModel;
use App\Database\Models\Companies\CompaniesModel;
use CodeIgniter\Test\CIUnitTestCase;

class CompaniesMock extends CIUnitTestCase
{
    const DATA = [
        [
            'id' => 1, // id inexistente
            'name' => 'Oliveis Moveis',
            'logotype' => 'http://localhost/public/avatar.png',
            'phone' => '5521966033549',
            'email' => 'jessica@companymarket.com.br',
            'inscribed_at' => '25/12/1995',
            'status' => 'ACTIVE',
            'document' => '17225479621',
            'document_type' => 'CPF',
        ],
        [
            'id' => 2, // id inexistente
            'name' => 'Lojinha Minha Esquina',
            'logotype' => 'http://localhost/public/avatar.png',
            'phone' => '55219752033549',
            'email' => 'eduardo@companymarket.com.br',
            'inscribed_at' => '25/10/2000',
            'status' => 'ACTIVE',
            'document' => '172485479621',
            'document_type' => 'CPF',
        ]
    ];

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        $companiesBusiness = new CompaniesBusiness();
        foreach (SELF::DATA as $data) {
            $companiesBusiness->store($data);
        }
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();

        $companiesModel  = new CompaniesModel();
        $companiesModel->where("1=1")->delete(null, true);
    }
}
