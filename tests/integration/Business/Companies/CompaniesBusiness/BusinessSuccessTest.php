<?php

namespace Tests\Integration\Business\Companies\CompaniesBusiness;

use App\Business\Companies\CompaniesBusiness;
use App\Database\Models\Companies\CompaniesModel;
use Tests\Support\Mocks\Companies\CompaniesMock;

class BusinessSuccessTest extends CompaniesMock
{
    protected $namespace = 'App';

    private CompaniesBusiness $business;
    protected function setUp(): void
    {
        parent::setUp();

        $this->business = new CompaniesBusiness();
    }

    public function testReturnExistInHasMethod()
    {
        $companiesModel = new CompaniesModel();
        $found = $companiesModel->first();

        $hasCompany = $this->business->has([
            'id' => $found->getId()
        ]);

        $this->assertTrue($hasCompany);
    }
}
