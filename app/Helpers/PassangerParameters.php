<?php

namespace App\Helpers;

class PassangerParameters
{

    /**
     * get function
     *
     * @param array $payload O array contendo todos os valores repassados via métodos
     * @param array $ignoreParams Os parâmetros que precisam ser ignorados ao decorrer da validação.
     * @param array<string, string> $options Algumas possíveis configurações para outros tipos de respostas.
     *
     * @return string
     */
    static function get(array $payload, array|Null $ignoreParams = [], array $options = [
        "separator" => "&",
        "assigner" => "="
    ])
    {
        $urlsParams = [];

        foreach (array_filter($payload, fn ($param) => !array_search($param, $ignoreParams)) as $index => $param) {
            array_push($urlsParams, $index . $options['assigner'] . $param);
        }

        return join($options['separator'], $urlsParams);
    }
}
