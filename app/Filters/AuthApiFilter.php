<?php

namespace App\Filters;

use App\Database\Entities\Users\UserEntity;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthApiFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = \session();

        /** @var UserEntity|null */
        $authenticated = $session->get(SESSION_KEY_AUTH_USER);

        $isUserInstance = ($authenticated instanceof UserEntity);

        if ($isUserInstance)
            return;

        $resp = service('response');

        return $resp
            ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED) // 401
            ->setJSON([
                'message'   => 'Api.user.not_access',
            ]);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Não é necessário fazer nada após a execução da requisição
    }
}
