<?php


if (!function_exists('validacaoCNPJ')) {
    function validacaoCNPJ(String $cnpj): String | false
    {
        $arrCNPJ = explode(".", $cnpj);
        $valor = $cnpj;

        if (count($arrCNPJ) < 3)
            $valor = null;
        if (strlen($arrCNPJ[0]) != 2 && strlen($arrCNPJ[1]) != 3)
            $valor = null;
        if (!strstr($arrCNPJ[2], '/0001') && strlen(explode("-", $arrCNPJ[2])[1]) == 2)
            $valor = null;

        return $valor;
    }
}
