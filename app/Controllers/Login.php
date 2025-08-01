<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index()
    {
        $session = session();

        if (!empty($session->get('userAuth')))
            return redirect("/dashboard/overview");

        return view("login");
    }
}
