<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

class Overview extends BaseController
{
    public function index()
    {
        return view("layouts/dashboard/overview/index");
    }
}
