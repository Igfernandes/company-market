<?php

namespace App\Controllers;


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
        return view("layouts/alter-password");
    }
}
