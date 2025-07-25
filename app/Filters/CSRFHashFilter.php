<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Config\Services;

class CSRFHashFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        /** @var Request $request */
        $security = Services::security();
        $token = $request->getHeaderLine("X-CSRF-TOKEN");
        $origin = env('globals.href.frontend', '*');

        $errorResponse = service('response')
            ->setHeader('Access-Control-Allow-Origin', $origin)
            ->setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization')
            ->setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE')
            ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED)
            ->setJSON([
                'errors' => 'Api.unauthorized',
            ]);

        if (empty($token) || !$security->verify($token)) {
            return $errorResponse;
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Não é necessário fazer nada após a execução da requisição
    }
}
