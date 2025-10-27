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

    public function login()
    {
        $session = session();
        $userAuth = $session->get(SESSION_KEY_AUTH_USER);
        $token = $this->request->getCookie('rm_token');

        if (empty($userAuth) && !empty($token))
            $userAuth =  RememberBusiness::isRememberTokenValid($token);

        if (!empty($userAuth))
            return redirect()->to('dashboard/overview');

        return view("layouts/login");
    }

    public function logout()
    {
        $session = session();
        /** @var UserEntity */
        $userAuth = $session->get(SESSION_KEY_AUTH_USER);
        $session->remove(SESSION_KEY_AUTH_USER);

        RememberBusiness::revokeRememberToken($userAuth->getId());

        return redirect('login');
    }
}
