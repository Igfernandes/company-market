<?php

use PHPUnit\Framework\TestCase;
use App\Libraries\Crypto\Crypto;

class CryptoTest extends TestCase
{
    protected Crypto $crypto;

    protected function setUp(): void
    {
        // Set as variáveis de ambiente para o teste
        putenv('system.crypt.cipher=aes-128-cbc');
        putenv('system.crypt.iv=1234567890123456');

        $this->crypto = new Crypto();
    }

    public function testEncryptReturnsDifferentString()
    {
        $plain = "Texto secreto";
        $key = "chave-secreta";

        $encrypted = $this->crypto->encrypt($plain, $key);

        $this->assertIsString($encrypted);
        $this->assertNotEquals($plain, $encrypted, "Encrypted string should be different from plain text");
    }

    public function testEncryptDecryptCycle()
    {
        $plain = "Texto para criptografar e descriptografar";
        $key = "minha-chave-secreta";

        $encrypted = $this->crypto->encrypt($plain, $key);
        $decrypted = $this->crypto->decrypt($encrypted, $key);

        $this->assertEquals($plain, $decrypted, "Decrypted text should match original plain text");
    }

    public function testDecryptWithWrongKeyReturnsNull()
    {
        $plain = "Texto para testar chave errada";
        $key = "chave-correta";
        $wrongKey = "chave-errada";

        $encrypted = $this->crypto->encrypt($plain, $key);
        $decrypted = $this->crypto->decrypt($encrypted, $wrongKey);

        $this->assertNull($decrypted, "Decrypt with wrong key should return null");
    }
}
