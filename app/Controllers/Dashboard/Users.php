<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

class Users extends BaseController
{
    public function index()
    {
        return view("layouts/dashboard/users/index");
    }

    public function trash()
    {
        return view("layouts/dashboard/users/trash");
    }
    
    public function roles()
    {
        return view("layouts/dashboard/users/roles");
    }
}
