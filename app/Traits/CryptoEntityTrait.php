<?php

namespace App\Traits;

use App\Libraries\Crypto\Crypto;

trait CryptoEntityTrait
{
    use EntityEnhancerTrait;

    private Crypto $cryptoLibrary;

    public function __construct()
    {
        parent::__construct();
        $this->cryptoLibrary = new Crypto();
    }

    public function getEncryptedKey()
    {
        return $this->cryptoLibrary->decrypt($this->attributes['system_key'], getenv('system.encrypted_key'));
    }
}
