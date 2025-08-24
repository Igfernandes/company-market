<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

class Users extends BaseController
{
    public function index()
    {
        return view("layouts/dashboard/users/index");
    }
}
