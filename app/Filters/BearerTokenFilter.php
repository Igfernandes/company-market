<?php

namespace App\Filters;

use App\Database\Entities\Users\UserAuthHistoryEntity;
use App\Database\Models\Users\UsersAuthHistoryModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Config\Services;

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

        if (empty($token))
            return $errorResponse;

        $cache = Services::cache();

        $userAuthId = $cache->get($token);
        
        if (!empty($userAuthId))
            return $session->set('userAuthId', $userAuthId);

        $userAuthHistory = new UserAuthHistoryEntity();
        $userAuthHistoryModel = new UsersAuthHistoryModel();
        $userAuthHistory->setToken($token);

        $foundAuthHistory = $userAuthHistoryModel->where($userAuthHistory->toArray(true))->first();

        if (empty($foundAuthHistory))
            return $errorResponse;

        $userId = $foundAuthHistory->getUserId();
        $cache->save($token, $userId, DAY_AT_SECONDS * 2);
        $session->set('userAuthId', $userId);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Não é necessário fazer nada após a execução da requisição
    }
}
