<?php

if (!function_exists('convertStringOfParameters')) {
    /**
     * @todo A função convertStringOfParameters é responsável por transformar um array em uma string de parâmetros para serem utilizados em uma URL.
     * 
     * @param array $payload O array contendo todos os valores repassados via métodos
     * @param array $ignoreParams Os parâmetros que precisam ser ignorados ao decorrer da validação.
     * @param array<string, string> $options Algumas possíveis configurações para outros tipos de respostas.
     * @param string $options["separator"] O separador que será utilizado para separar os parâmetros. 
     * @param string $options["assigner"] O separador que será utilizado para atribuir um valor a um parâmetro.
     *
     * @return string
     */
    function convertUrlParameters(array $payload, array|Null $ignoreParams = [], array $options = [
        "separator" => "&",
        "assigner" => "="
    ])
    {
        $urlsParams = [];

        foreach (array_filter($payload, fn ($param) => array_search($param, $ignoreParams) === false) as $index => $param) {
            array_push($urlsParams, $index . $options['assigner'] . $param);
        }

        return join($options['separator'], $urlsParams);
    }
}
