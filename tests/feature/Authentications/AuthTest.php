<?php

namespace Tests\Feature\Authentications;

use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Test\FeatureTestTrait;
use CodeIgniter\Test\ReflectionHelper;
use CodeIgniter\Test\CIUnitTestCase;

function validateRecaptcha($params)
{
    return $params['token'] === 'valid';
}

class AuthTest extends CIUnitTestCase
{
    use FeatureTestTrait;
    use ReflectionHelper;  // essencial para getPrivateProperty usado internamente

    private string $route = '/api/auth';

    public function testSendPayloadEmpty()
    {
        $result = $this->call("post", $this->route);

        $result->assertStatus(ResponseInterface::HTTP_BAD_REQUEST);
        $result->assertJSONFragment(['error' => 'Api.invalid.email']);
    }

    public function testInvalidRecaptcha()
    {
        $result = $this->call('post', $this->route, [
            'login' => 'companymarketbr@gmail.com',
            'password' => 'aA@123445642!',
            'recaptcha' => 'invalid',
        ]);

        $result->assertStatus(ResponseInterface::HTTP_UNAUTHORIZED);
        $result->assertJSONFragment(['error' => 'Api.auth.invalid.recaptcha']);
    }

    public function testCredentialInvalids()
    {
        $result = $this->post($this->route, [
            'login' => 'notfound@email.com',
            'password' => 'Senha123!',
            'recaptcha' => getenv('globals.recaptcha.tokenTest'),
            'remember-me' => '0'
        ]);
        $result->assertStatus(ResponseInterface::HTTP_NOT_ACCEPTABLE);
        $result->assertJSONFragment(['error' => 'Api.auth.invalid.credentials']);
    }

    public function testLoginValidWithoutRememberMe()
    {
        $result = $this->post($this->route, [
            'login' => getenv('globals.admin.login'),
            'password' => getenv('globals.admin.password'),
            'recaptcha' => getenv('globals.recaptcha.tokenTest'),
        ]);

        $result->assertStatus(ResponseInterface::HTTP_OK); // OK = 200
        $result->assertJSONFragment(['success' => 'Api.auth.success.post']);
        $result->assertJSONMissing(['reference_token']);
    }

    public function testLoginValidWithRememberMe()
    {
        $result = $this->post($this->route, [
            'login' => getenv('globals.admin.login'),
            'password' => getenv('globals.admin.password'),
            'recaptcha' => getenv('globals.recaptcha.tokenTest'),
            'remember-me' => '1'
        ]);

        $result->assertJSONFragment(['success' => 'Api.auth.success.post']);
        $result->assertStatus(Response::HTTP_OK);
        $data = json_decode($result->getJSON(), true);
        $this->assertArrayHasKey('reference_token', $data);
    }
}
