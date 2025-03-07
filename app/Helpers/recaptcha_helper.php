<?php

use Config\Recaptcha;

if (!function_exists('validateRecaptcha')) {
    /**
     * Valida um token do reCAPTCHA v3 usando a API do Google.
     *
     * Essa função envia uma requisição HTTP POST para a API do Google reCAPTCHA 
     * para verificar a validade do token fornecido. Retorna verdadeiro se o 
     * token for válido e a pontuação for maior ou igual a 0.5, caso contrário, retorna falso.
     *
     * @param string $token O token do reCAPTCHA v3 a ser validado.
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
    function validateRecaptcha(string $token): bool
    {
        $config = new Recaptcha();
        // URL da API de verificação do reCAPTCHA v3
        $verifyURL = 'https://www.google.com/recaptcha/api/siteverify';

        // Inicializando o cURL
        $ch = curl_init();

        // Configurando as opções do cURL
        curl_setopt($ch, CURLOPT_URL, $verifyURL);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'secret' =>   $config->secretKey,
            'response' => $token
        ]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Ignorando a verificação do SSL (não recomendado em produção)
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // Executando a requisição
        $response = curl_exec($ch);

        // Fechando o cURL
        curl_close($ch);

        // Decodificando a resposta JSON da API
        $responseKeys = json_decode($response, true);

        return $responseKeys["success"] && $responseKeys["score"] >= 0.5;
    }
}
