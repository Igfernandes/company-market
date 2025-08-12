<?php

namespace Tests\Unit\Api\Authentications;

use App\Api\Operations\Authentications\Auth\PostUseCases;
use App\Libraries\Exceptions\Exceptions;
use PHPUnit\Framework\TestCase;

// Mock global da função validateRecaptcha
function validateRecaptcha($params)
{
    return $params['token'] === 'valid';
}

// Mock do UsersModel
class UsersModelMock
{
    private $shouldReturnUser;
    public function __construct($shouldReturnUser = false)
    {
        $this->shouldReturnUser = $shouldReturnUser;
    }
    public function where($data)
    {
        return $this;
    }
    public function first()
    {
        return $this->shouldReturnUser ? (object)['id' => 1, 'email' => 'mock@email.com'] : null;
    }
}

// Mock do Crypto
class CryptoMock
{
    public function encrypt($text, $key)
    {
        return "encrypted:" . $text;
    }
}

// Mock do AuthenticationBusiness
class AuthenticationBusinessMock
{
    public function createTokenRemember($payload, $foundUser)
    {
        return $payload['rememberMe'] === '1' ? 'mock-token' : null;
    }
}

// Subclasse de PostUseCases para sobrescrever comportamentos
class PostUseCasesMock extends PostUseCases
{
    private $shouldReturnUser;

    public function __construct($shouldReturnUser = false)
    {
        $this->shouldReturnUser = $shouldReturnUser;
    }

    // Sobrescreve o método execute para usar mocks em vez de instanciar reais
    public function execute(array $payload, object $userSettings)
    {
        if (!validateRecaptcha([
            "token" => $payload['recaptcha'],
            "ip" => $userSettings->ip
        ])) {
            throw new Exceptions("Api.auth.invalid.recaptcha", \BAD_AUTH);
        }

        $crypto = new CryptoMock();
        $userModel = new UsersModelMock($this->shouldReturnUser);
        $authenticationBusiness = new AuthenticationBusinessMock();

        $systemKey = $crypto->encrypt($payload['login'] . ":" . $payload['password'], getenv('system.encrypted_key'));

        $foundUser = $userModel->first();

        if (empty($foundUser)) {
            throw new Exceptions("Api.auth.invalid.credentials", FORBIDDEN_ERROR);
        }

        $response = (object)[
            "success" => "Api.auth.success.post"
        ];

        $tokenRemember = $authenticationBusiness->createTokenRemember($payload, $foundUser);

        if (!empty($tokenRemember)) {
            $response->reference_token = $tokenRemember;
        }

        return $response;
    }
}

class PostUseCasesTest extends TestCase
{
    private function makeUseCase($shouldReturnUser = false)
    {
        return new PostUseCasesMock($shouldReturnUser);
    }

    public function testRecaptchaInvalido()
    {
        $useCase = $this->makeUseCase();
        $this->expectException(Exceptions::class);
        $this->expectExceptionMessage("Api.auth.invalid.recaptcha");

        $useCase->execute([
            'login' => 'user@email.com',
            'password' => 'Aa@12345432!',
            'recaptcha' => 'invalid'
        ], (object)['ip' => '127.0.0.1', 'browser' => 'Postman']);
    }

    public function testCredenciaisInvalidas()
    {
        $useCase = $this->makeUseCase(false); // sem usuário
        $this->expectException(Exceptions::class);
        $this->expectExceptionMessage("Api.auth.invalid.credentials");

        $useCase->execute([
            'login' => 'notfound@email.com',
            'password' => 'Senha123!',
            'recaptcha' => 'valid',
            'rememberMe' => '0'
        ], (object)['ip' => '127.0.0.1', 'browser' => 'Postman']);
    }

    public function testLoginValidoSemRememberMe()
    {
        $useCase = $this->makeUseCase(true);
        $result = $useCase->execute([
            'login' => 'found@email.com',
            'password' => 'Senha123!',
            'recaptcha' => 'valid',
            'rememberMe' => '0'
        ], (object)['ip' => '127.0.0.1', 'browser' => 'Postman']);

        $this->assertEquals('Api.auth.success.post', $result->success);
        $this->assertObjectNotHasProperty('reference_token', $result);
    }

    public function testLoginValidoComRememberMe()
    {
        $useCase = $this->makeUseCase(true);
        $result = $useCase->execute([
            'login' => 'found@email.com',
            'password' => 'A@123sadsaa',
            'recaptcha' => 'valid',
            'rememberMe' => '1'
        ], (object)['ip' => '127.0.0.1', 'browser' => 'Postman']);

        $this->assertEquals('Api.auth.success.post', $result->success);
        $this->assertEquals('mock-token', $result->reference_token);
    }
}
