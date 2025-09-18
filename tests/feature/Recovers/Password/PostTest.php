<?php

namespace Tests\Feature\Recovers\Password;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Test\FeatureTestTrait;
use CodeIgniter\Test\ReflectionHelper;
use CodeIgniter\Test\CIUnitTestCase;

class PostTest extends CIUnitTestCase
{
    use FeatureTestTrait;
    use ReflectionHelper;  // essencial para getPrivateProperty usado internamente

    private string $route = '/api/recovers/password';

    public function testSendPayloadEmpty()
    {
        $result = $this->call("post", $this->route);

        $result->assertStatus(\BAD_REQUEST);
        $result->assertJSONFragment(['error' => 'Api.recovers.password.invalid.email']);
    }

    public function testInvalidRecaptcha()
    {
        $result = $this->call('post', $this->route, [
            'email' => 'companymarketbr@gmail.com',
            'recaptcha' => 'invalid',
        ]);

        $result->assertStatus(BAD_AUTH);
        $result->assertJSONFragment(['error' => 'Api.auth.invalid.recaptcha']);
    }

    public function testEmailInvalidButReturnSuccess()
    {
        $result = $this->post($this->route, [
            'email' => 'notfound@email.com',
            'recaptcha' => getenv('globals.recaptcha.tokenTest'),
        ]);

        $result->assertStatus(OK);
        $result->assertJSONFragment(['success' => 'Api.users.success.recover_password']);
    }


    public function testSuccessSend()
    {
        $result = $this->post($this->route, [
            'email' => getenv('globals.admin.login'),
            'recaptcha' => getenv('globals.recaptcha.tokenTest'),
        ]);

        $result->assertStatus(ResponseInterface::HTTP_OK);
        $result->assertJSONFragment(['success' => 'Api.users.success.recover_password']);
    }
}
