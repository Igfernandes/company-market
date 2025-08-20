<?php

namespace Tests\Feature\Recovers\Password;

use CodeIgniter\Test\FeatureTestTrait;
use CodeIgniter\Test\ReflectionHelper;
use CodeIgniter\Test\CIUnitTestCase;

class PutTest extends CIUnitTestCase
{
    use FeatureTestTrait;
    use ReflectionHelper;  // essencial para getPrivateProperty usado internamente

    private string $route = '/api/recovers/password';

    public function testSendPayloadEmpty()
    {
        $result = $this->put($this->route);

        $result->assertStatus(\BAD_REQUEST);
        $result->assertJSONFragment(['error' => 'Api.recovers.password.invalid.token']);
    }

    public function testInvalidRecoverToken()
    {
        $result = $this->withBody(json_encode([
            'password' => 'invalid',
        ]), 'application/json')->put($this->route);

        $result->assertStatus(BAD_REQUEST);
        $result->assertJSONFragment(['error' => 'Api.recovers.password.invalid.token']);
    }

    public function testInvalidPassword()
    {
        $result = $this->withBody(json_encode([
            'token' => 'assdssdg'
        ]), 'application/json')->put($this->route);

        $result->assertStatus(BAD_REQUEST);
        $result->assertJSONFragment(['error' => 'Api.recovers.password.invalid.password']);
    }
}
