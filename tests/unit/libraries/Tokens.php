<?php

use PHPUnit\Framework\TestCase;
use App\Libraries\Tokens\Tokens;

class TokensTest extends TestCase
{
    protected Tokens $tokens;

    protected function setUp(): void
    {
        $this->tokens = new Tokens();
    }

    public function testCreateReturnsString()
    {
        $token = $this->tokens->create(3, 4);
        $this->assertIsString($token);
        $this->assertNotEmpty($token);
    }

    public function testCreateTokenFormat()
    {
        $blocks = 4;
        $bytes = 2;

        $token = $this->tokens->create($blocks, $bytes);

        // Token deve ter (blocks - 1) hífens, porque junta os blocos com '-'
        $this->assertEquals($blocks - 1, substr_count($token, '-'));

        // Cada bloco tem bytes * 2 caracteres em hexadecimal
        $chunks = explode('-', $token);
        $this->assertCount($blocks, $chunks);

        foreach ($chunks as $chunk) {
            $this->assertEquals($bytes * 2, strlen($chunk));
            $this->assertMatchesRegularExpression('/^[a-f0-9]+$/', $chunk);
        }
    }

    public function testCreateDefaultBytes()
    {
        // Quando bytes não é passado, deve usar 2 por padrão
        $blocks = 3;
        $token = $this->tokens->create($blocks);

        $chunks = explode('-', $token);
        $this->assertCount($blocks, $chunks);

        foreach ($chunks as $chunk) {
            $this->assertEquals(4, strlen($chunk)); // 2 bytes * 2 chars por byte
        }
    }
}
