<?php

namespace App\Libraries\HttpClient;

class HttpClient
{
    /**
     * Faz uma requisição HTTP com cURL.
     * 
     * @param string $method  Método HTTP: GET, POST, PUT, DELETE, etc
     * @param string $url     URL do endpoint
     * @param array  $headers Array associativo ou indexado de headers (ex: ['Content-Type: application/json'])
     * @param mixed  $body    Dados para enviar no corpo (string ou array que será json_encode)
     * @param int    $timeout Tempo limite em segundos (default 30)
     * 
     * @return array ['status' => int, 'response' => string, 'error' => string|null]
     */
    public static function request(string $method, string $url, array $headers = [], $body = null, int $timeout = 30): array
    {
        $ch = curl_init();

        $method = strtoupper($method);

        // Configurações básicas
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);

        // Configura método HTTP
        switch ($method) {
            case 'POST':
                curl_setopt($ch, CURLOPT_POST, true);
                if ($body !== null) {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, is_array($body) ? json_encode($body) : (array)$body);
                }
                break;

            case 'PUT':
            case 'PATCH':
            case 'DELETE':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
                if ($body !== null) {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, is_array($body) ? json_encode($body) : $body);
                }
                break;

            case 'GET':
                // Para GET o body não é usado no cURL
                break;

            default:
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
                if ($body !== null) {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, is_array($body) ? json_encode($body) : $body);
                }
                break;
        }

        // Headers
        if (!empty($headers)) {
            // Se os headers forem associados, transforma em array de strings 'Chave: Valor'
            if (array_keys($headers) !== range(0, count($headers) - 1)) {
                $formattedHeaders = [];
                foreach ($headers as $key => $value) {
                    $formattedHeaders[] = "$key: $value";
                }
                $headers = $formattedHeaders;
            }
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        $response = curl_exec($ch);
        $error = null;
        if (curl_errno($ch)) {
            $error = curl_error($ch);
        }

        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        return [
            'status' => $statusCode,
            'response' => $response,
            'error' => $error,
        ];
    }
}
