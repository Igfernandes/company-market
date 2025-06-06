<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Recaptcha extends BaseConfig
{
    public string $siteKey = 'YOUR_SITE_KEY';    // Substitua pela sua Site Key
    public string $secretKey = ""; // Substitua pela sua Secret Key
    public float $minScore = 0.5;                // Pontuação mínima para validar

    public function __construct()
    {
        $this->secretKey = getenv("globals.recaptcha.secretKey");
        $this->siteKey = getenv("globals.recaptcha.siteKey");
    }
}
