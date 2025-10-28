<?php

namespace App\Controllers\Dashboard;

use App\Business\Integrations\IntegrationsSearchBusiness;
use App\Controllers\BaseController;
use App\Database\Entities\Clients\CategoryEntity;
use App\Database\Models\Clients\CategoriesModel;
use App\Database\Models\Clients\ClientsCategoriesModel;
use App\Database\Models\Clients\ClientsModel;
use App\Database\Models\Companies\CompaniesModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Companies extends BaseController
{

    public function index()
    {
        return view("layouts/dashboard/companies/index", []);
    }

    public function create()
    {

        return view("layouts/dashboard/companies/forms");
    }

    public function form(int $companyId = 0)
    {
        $companiesModel = new CompaniesModel();
        $found = $companiesModel->where([
            "id" => $companyId
        ])->first();

        if (empty($found))
            throw new PageNotFoundException();

        $integrations = IntegrationsSearchBusiness::getOrderByProvider([
            "company_id" => $companyId
        ]);

        return view("layouts/dashboard/companies/forms", [
            "id" => $companyId,
            "company" => $found,
            "integrations" =>  $integrations
        ]);
    }

    public function trash()
    {
        return view("layouts/dashboard/companies/trash");
    }
}
