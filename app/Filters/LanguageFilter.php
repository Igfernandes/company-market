<?php

namespace App\Filters;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\Request;  // Importe a classe Request

class LanguageFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        /** @var Request $request */
        $request = $request;  // Isso assegura que a tipagem seja resolvida corretamente

        // Verifica se o idioma está armazenado na sessão
        $session = service('session');
        $requestLang = $request->getHeaderLine("lang");
        $locale = $requestLang ? $requestLang : $session->get('lang');

        // Se não houver idioma na sessão, use o padrão do app
        if (!$locale) {
            $locale = config('App')->defaultLocale;
            $session->set('lang', $locale);
        }

        // Define o idioma para toda a aplicação
        service('request')->setLocale($locale);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Não precisa fazer nada após a resposta
    }
}
