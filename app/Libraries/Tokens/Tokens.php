<?php

/**
 * @see Token
 * 
 *  A classe responsável pela produção de Tokens internos do sistema para validação de ações.
 *  O objetivo dessa classe é manipular as informações do usuário que irá receber o token, verificar
 *  o modelo de token a ser enviado e utilizar a biblioteca PHPMailer para submeter. Ele também irá 
 *  salvar respostas no banco de dados, mas apenas informações sobre o envio correto ou não. Caso não
 *  grave alguma informação, verifique a integridade dos models chamados abaixo ou os parâmetros abaixo
 *  citados.
 */

namespace App\Libraries\Tokens;

class Tokens
{
    /**
     * create function
     *
     * @param Int $bytes    O comprimento de cada bloco de caracteres do token
     * @param Int $blocks   A quantidade de blocos de caracteres
     * @return String 
     */
    public function create(Int $blocks, Int $bytes = 2): String
    {
        $token = '';
        for ($x = 1; $x <= $blocks; $x++) {
            $bts = openssl_random_pseudo_bytes($bytes);
            $hex   = bin2hex($bts);

            $token = "$token-$hex";
        }

        return substr($token, 1);
    }
}
