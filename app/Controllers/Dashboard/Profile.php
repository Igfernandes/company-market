<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

class Profile extends BaseController
{
    public function index()
    {
        $session = session();
        $userAuth = $session->get(SESSION_KEY_AUTH_USER);

        return view("layouts/dashboard/profile/index", [
            "user" => $userAuth
        ]);
    }
}
