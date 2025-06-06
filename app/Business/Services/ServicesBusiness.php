<?php

namespace App\Business\Services;

use App\Business\BaseBusiness;
use App\Database\Models\Services\ServicesModel;

class ServicesBusiness
{
    use BaseBusiness;

    private ServicesModel $serviceModel;

    public function __construct()
    {
        $this->serviceModel = new ServicesModel();
    }

    public function hasService($query): bool
    {
        $foundUsers = $this->serviceModel->where($query)->first();

        return !empty($foundUsers);
    }
}
