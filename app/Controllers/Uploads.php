<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;

class Uploads extends BaseController
{
    public function image($filename)
    {
        $path = WRITEPATH . 'uploads/images/' . basename($filename);

        $response = service('response');

        if (!is_file($path)) {
            return $response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND);
        }

        return $response
            ->setHeader('Content-Type', mime_content_type($path))
            ->setBody(file_get_contents($path));
    }

    public function fields($filename)
    {
        $path = WRITEPATH . 'uploads/fields/' . basename($filename);

        $response = service('response');

        if (!is_file($path)) {
            return $response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND);
        }

        return $response
            ->setHeader('Content-Type', mime_content_type($path))
            ->setBody(file_get_contents($path));
    }

    public function services($filename)
    {
        $path = WRITEPATH . 'uploads/services/' . basename($filename);

        $response = service('response');

        if (!is_file($path)) {
            return $response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND);
        }

        return $response
            ->setHeader('Content-Type', mime_content_type($path))
            ->setBody(file_get_contents($path));
    }

    public function pdfs($filename)
    {
        $path = WRITEPATH . 'uploads/pdfs/' . basename($filename);

        $response = service('response');

        if (!is_file($path)) {
            return $response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND);
        }

        return $response
            ->setHeader('Content-Type', mime_content_type($path))
            ->setBody(file_get_contents($path));
    }

    public function excels($filename)
    {
        $path = WRITEPATH . 'uploads/excels/' . basename($filename);

        $response = service('response');

        if (!is_file($path)) {
            return $response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND);
        }

        return $response
            ->setHeader('Content-Type', mime_content_type($path))
            ->setBody(file_get_contents($path));
    }
}
