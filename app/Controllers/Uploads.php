<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;

class Uploads extends BaseController
{
    public function image($filename)
    {
        $path = WRITEPATH . 'uploads/' . basename($filename);
      
        $response = service('response');

        if (!is_file($path)) {
            return $response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND);
        }
        
        return $response
            ->setHeader('Content-Type', mime_content_type($path))
            ->setBody(file_get_contents($path));
    }
}
