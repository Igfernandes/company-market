<?php

namespace Tests\Feature\Authentications;

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

        $result->assertStatus(\BAD_REQUEST);
        $result->assertJSONFragment(['error' => 'Api.invalid.email']);
    }

    public function testInvalidRecaptcha()
    {
        $result = $this->call('post', $this->route, [
            'login' => 'companymarketbr@gmail.com',
            'password' => 'aA@123445642!',
            'recaptcha' => 'invalid',
        ]);

        $result->assertStatus(BAD_AUTH);
        $result->assertJSONFragment(['error' => 'Api.auth.invalid.recaptcha']);
    }

    public function testCredenciaisInvalidas()
    {
        $result = $this->post($this->route, [
            'login' => 'notfound@email.com',
            'password' => 'Senha123!',
            'recaptcha' => getenv('globals.recaptcha.tokenTest'),
            'remember-me' => '0'
        ]);
        $result->assertStatus(\BAD_BUSINESS_RULES); // BAD_BUSINESS_RULES ex: 403
        $result->assertJSONFragment(['error' => 'Api.auth.invalid.credentials']);
    }

    public function testLoginValidoSemRememberMe()
    {
        $result = $this->post($this->route, [
            'login' => getenv('globals.admin.login'),
            'password' => getenv('globals.admin.password'),
            'recaptcha' => getenv('globals.recaptcha.tokenTest'),
        ]);
        $result->assertStatus(200); // OK = 200
        $result->assertJSONFragment(['success' => 'Api.auth.success.post']);
        $result->assertJSONMissing(['reference_token']);
    }

    public function testLoginValidoComRememberMe()
    {
        $result = $this->post($this->route, [
            'login' => getenv('globals.admin.login'),
            'password' => getenv('globals.admin.password'),
            'recaptcha' => getenv('globals.recaptcha.tokenTest'),
            'remember-me' => '1'
        ]);

        $result->assertStatus(OK);
        $result->assertJSONFragment(['success' => 'Api.auth.success.post']);
        $data = json_decode($result->getJSON(), true);
        $this->assertArrayHasKey('reference_token', $data);
    }
}
