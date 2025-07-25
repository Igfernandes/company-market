<?php

namespace App\Controllers;

use App\Database\Models\Services\ServicesModel;

class Emails extends BaseController
{

    public function index()
    {
        $servicesModel = new ServicesModel();
        $service =   $servicesModel->first();
        echo  view('mails/unsubscribe', [
            'service' => $service,
            'client' => "Eduardo Almeida"
        ]);
    }
}
