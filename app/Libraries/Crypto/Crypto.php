<?php

namespace App\Libraries\Crypto;

/**
 * @see Crypto 
 * 
 *  A classe responsável por disponibilizar recursso de criptografia para o projeto.
 */

class Crypto
{
    protected String $cipher;
    protected String $iv;

    public function __construct()
    {
        $this->cipher = getenv('system.crypt.cipher');
        $this->iv = getenv('system.crypt.iv');
    }

    function encrypt($pure_string, $encryption_key)
    {
        $encryption_key = substr(hash('sha256', $encryption_key, true), 0, 16);
        $ciphertext_raw = openssl_encrypt($pure_string, $this->cipher, $encryption_key, OPENSSL_RAW_DATA, $this->iv);
        $hmac = hash_hmac('sha256', $ciphertext_raw, $encryption_key, true);
        return $this->iv . $hmac . $ciphertext_raw;
    }

    function decrypt($encrypted_string, $encryption_key)
    {
        $encryption_key = substr(hash('sha256', $encryption_key, true), 0, 16);
        $c = $encrypted_string ?? "";
        $ivlen = openssl_cipher_iv_length($this->cipher);
        $iv = substr($c, 0, $ivlen);
        $hmac = substr($c, $ivlen, $sha2len = 32);
        $ciphertext_raw = substr($c, $ivlen + $sha2len);
        $original_plaintext = openssl_decrypt($ciphertext_raw, $this->cipher, $encryption_key, OPENSSL_RAW_DATA, $iv);
        $calcmac = hash_hmac('sha256', $ciphertext_raw, $encryption_key, true);
        if (hash_equals($hmac, $calcmac)) // timing attack safe comparison
        {
            return $original_plaintext;
        }
    }
}
