<?php

namespace App\Controllers;

class Index extends BaseController
{

    public function index()
    {
        $uri = service('uri')->getPath();
        $isApi = str_starts_with($uri, 'api');

        $response = service('response');
        $response->setStatusCode(NOT_FOUND);
        $response->setContentType('application/json');

        return $response->setJSON([
            'status'  => false,
            'error'   => NOT_FOUND,
            'message' => "not_found",
        ])->getBody();
    }
}
