<?php


if (!function_exists('validacaoCPF')) {
    function validacaoCPF(String $cpf): String | false
    {
        $arrCPF = explode(".", $cpf);
        $valor = $cpf;

        if (count($arrCPF) < 3)
            $valor = null;
        if (strlen($arrCPF[0]) != 2 && strlen($arrCPF[1]) != 3)
            $valor = null;
        if (!strlen(explode("-", $arrCPF[2])[1]) == 2)
            $valor = null;

        return $valor;
    }
}
