<?php

namespace App\Controllers;

use App\Business\Users\UsersTokensBusiness;
use CodeIgniter\Exceptions\PageNotFoundException;

class Index extends BaseController
{
    public function index()
    {
        return view("index");
    }

    public function login()
    {
        $session = session();

        if (!empty($session->get('userAuth')))
            return redirect("/dashboard/overview");

        return view("layouts/login");
    }


    public function forgotPassword()
    {
        return view("layouts/forgot-password");
    }

    public function alterPassword()
    {
        $token = $this->request->getVar("k");
        $usersTokensBusiness = new UsersTokensBusiness();

        $userToken =  $usersTokensBusiness->getAvailableRelationUserToken($token);

        if (empty($userToken))
            throw PageNotFoundException::forPageNotFound();

        return view("layouts/alter-password");
    }
}
