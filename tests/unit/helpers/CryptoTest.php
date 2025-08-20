<?php

namespace Tests\Unit;

use CodeIgniter\Test\CIUnitTestCase;

class CryptoTest extends CIUnitTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        helper('crypto'); // carrega sua função
    }

    public function testReferenceHashReturnsSha256Hash(): void
    {
        $value = 'teste123';
        $expectedHash = hash('sha256', $value);

        $this->assertSame($expectedHash, referenceHash($value));
    }

    public function testReferenceHashIsDifferentForDifferentValues(): void
    {
        $value1 = 'teste123';
        $value2 = 'teste456';

        $this->assertNotSame(referenceHash($value1), referenceHash($value2));
    }

    public function testReferenceHashAlwaysReturns64CharacterString(): void
    {
        $value = 'anyValue';
        $hash = referenceHash($value);

        $this->assertEquals(64, strlen($hash));
    }
}
