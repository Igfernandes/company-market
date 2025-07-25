<?php


if (!function_exists('isJsonValid')) {
    /**
     * Retorna todos os valores das propriedades de um objeto.
     *
     * @param object $obj O objeto de onde os valores serão extraídos.
     * @return array Um array associativo com os nomes das propriedades como chaves e seus valores.
     */
    function isJsonValid(string $json): bool
    {
        // Precisa ser uma string não vazia
        if (!is_string($json) || trim($json) === '') {
            return false;
        }

        // Decodifica com json_decode
        json_decode($json);

        // Verifica se houve erro
        return json_last_error() === JSON_ERROR_NONE;
    }
}
