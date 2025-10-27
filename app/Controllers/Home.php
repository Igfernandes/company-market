<?php

namespace App\Controllers;

use App\Business\Authentications\RememberBusiness;
use App\Business\Users\UsersTokensBusiness;
use App\Database\Entities\Users\UserEntity;
use CodeIgniter\Exceptions\PageNotFoundException;

class Home extends BaseController
{
    public function index()
    {
        return view("layouts/index");
    }

    public function email()
    {
        return view("mails/subscribe");
    }
}
