<?php

namespace App\Filters;

use App\Business\Authentication\UserAuthHistoryBusiness;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class BearerTokenFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        /** @var Request $request */
        $request = $request;  // Isso assegura que a tipagem seja resolvida corretamente
        $session = session();

        $errorResponse = service('response')->setStatusCode(NOT_FOUND)
            ->setJSON([
                'errors' => lang("Errors.not_found"),
            ]);
        // Recupera o token Bearer do cabeçalho da requisição
        $authorizationHeader = $request->getHeader('Authorization');

        if (!$authorizationHeader)
            return $errorResponse;

        // O valor do Authorization deve estar no formato "Bearer <token>"
        $headerValue = $authorizationHeader->getValue();
        $token = null;

        // Verifica se o cabeçalho está no formato correto
        if (strpos($headerValue, 'Bearer ') === 0) {
            // Remove o "Bearer " do início do valor
            $token = substr($headerValue, 7);
        }

        $userAuthHistoryBusiness = new UserAuthHistoryBusiness();

        $userAuthId = $userAuthHistoryBusiness->handleAuthNavigation($token);

        if ($userAuthId == false)
            return $errorResponse;

        $session->set('userAuthId', $userAuthId);
        $session->set('tokenNavigation', $token);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Não é necessário fazer nada após a execução da requisição
    }
}
