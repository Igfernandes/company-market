<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Errors extends Controller
{
    public function notFound()
    {
        // Retorna a view personalizada de erro 404
        return "error";
    }
}
