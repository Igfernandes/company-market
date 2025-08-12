<?php

use PHPUnit\Framework\TestCase;
use App\Libraries\HttpClient\HttpClient;

class RecaptchaTest extends TestCase
{
    protected function setUp(): void
    {
        putenv('globals.recaptcha.tokenTest=test-token');
    }

    protected function tearDown(): void
    {
        putenv('globals.recaptcha.tokenTest');
    }

    public function testReturnsTrueForTokenTest()
    {
        $result = validateRecaptcha(['token' => 'test-token']);
        $this->assertTrue($result);
    }

    public function testReturnsTrueWhenHttpClientReturnsSuccess()
    {
        $mockClient = $this->createMock(HttpClient::class);
        $mockClient->method('request')->willReturn([
            'response' => json_encode(['success' => true])
        ]);

        $result = validateRecaptcha(['token' => 'valid-token', 'ip' => '127.0.0.1'], $mockClient);
        $this->assertTrue($result);
    }

    public function testReturnsFalseWhenHttpClientReturnsFailure()
    {
        $mockClient = $this->createMock(HttpClient::class);
        $mockClient->method('request')->willReturn([
            'response' => json_encode(['success' => false])
        ]);

        $result = validateRecaptcha(['token' => 'invalid-token', 'ip' => '127.0.0.1'], $mockClient);
        $this->assertFalse($result);
    }
}
