<?php

use App\Libraries\HttpClient\HttpClient;
use Config\Recaptcha;

if (!function_exists('validateRecaptcha')) {
    /**
     * Valida um token do reCAPTCHA usando a API do CloudFlare.
     *
     * Essa função envia uma requisição HTTP POST para a API do Google reCAPTCHA 
     * para verificar a validade do token fornecido. Retorna verdadeiro se o 
     * token for válido.
     *
     * @param array{
     *      ip: string,
     *      token: string
     * } $props O token do reCAPTCHA a ser validado e o ip do usuário.
     * @return bool Retorna `true` se o token for válido e a pontuação >= 0.5, caso contrário, retorna `false`.
     *
     * @throws \RuntimeException Se a requisição cURL falhar.
     *
     * @example
     * $isValid = validateRecaptcha('token_aqui');
     * if ($isValid) {
     *     echo "Verificação do reCAPTCHA bem-sucedida!";
     * } else {
     *     echo "Falha na verificação do reCAPTCHA.";
     * }
     */
    function validateRecaptcha(array $props): bool
    {
        $config = new Recaptcha();
        // URL da API de verificação do reCAPTCHA
        $verifyURL = 'https://api.hcaptcha.com/siteverify';

        $payload = (object)[
            'secret' =>   $config->secretKey,
            'response' => $props['token']
        ];

        if (isset($props['ip']))
            $payload->remoteip = $props['ip'];

        // Executando a requisição
        $data =   HttpClient::request("POST", $verifyURL, [
            "Content-Type" => "multipart/form-data"
        ],  $payload);

        $response = json_decode($data["response"]);

        return isset($response->success) && $response->success;
    }
}
