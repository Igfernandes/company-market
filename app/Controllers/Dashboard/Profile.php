<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

class Profile extends BaseController
{
    public function index()
    {
        return view("layouts/dashboard/profile/index");
    }
}
