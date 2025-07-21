<?php

namespace App\Controllers;

use App\Api\Exports\Post\PostUseCases;

class Index extends BaseController
{
    public function index()
    {


        return view("index");
    }
}
