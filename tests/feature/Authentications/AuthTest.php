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
        $result->assertJSONFragment(['errors' => 'Api.auth.invalid.recaptcha']);
    }

    // public function testCredenciaisInvalidas()
    // {
    //     $result = $this->post($this->route, [
    //         'login' => 'notfound@email.com',
    //         'password' => 'Senha123!',
    //         'recaptcha' => 'valid',
    //         'rememberMe' => '0'
    //     ]);
    //     $result->assertStatus(403); // BAD_BUSINESS_RULES ex: 403
    //     $result->assertJSONFragment(['errors' => 'Api.auth.invalid.credentials']);
    // }

    // public function testLoginValidoSemRememberMe()
    // {
    //     $result = $this->post($this->route, [
    //         'login' => 'test@email.com',
    //         'password' => 'Senha123!',
    //         'recaptcha' => 'valid',
    //         'rememberMe' => '0'
    //     ]);
    //     $result->assertStatus(200); // OK = 200
    //     $result->assertJSONFragment(['success' => 'Api.auth.success.post']);
    //     $result->assertJSONMissing(['reference_token']);
    // }

    // public function testLoginValidoComRememberMe()
    // {
    //     $result = $this->post($this->route, [
    //         'login' => 'test@email.com',
    //         'password' => 'Senha123!',
    //         'recaptcha' => 'valid',
    //         'rememberMe' => '1'
    //     ]);
    //     $result->assertStatus(200);
    //     $result->assertJSONFragment(['success' => 'Api.auth.success.post']);
    //     $data = json_decode($result->getJSON(), true);
    //     $this->assertArrayHasKey('reference_token', $data);
    // }
}
