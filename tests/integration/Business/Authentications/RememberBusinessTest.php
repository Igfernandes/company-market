<?php

namespace Tests\Integration\Business\Authentications;

use App\Business\Authentications\RememberBusiness;
use App\Database\Entities\Users\UserEntity;
use App\Database\Models\Users\UsersModel;
use App\Database\Models\Users\RememberModel;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;

class RememberBusinessTest extends CIUnitTestCase
{
    use DatabaseTestTrait;

    protected $refresh = true;
    protected $seed = 'Tests\Support\Database\Seeds\UsersSeeder'; // opcional

    private UsersModel $usersModel;
    private RememberModel $rememberModel;

    protected function setUp(): void
    {
        parent::setUp();
        $this->usersModel = new UsersModel();
        $this->rememberModel = new RememberModel();
    }

    public function testCreateTokenRemember()
    {
        $user = $this->createFakeUser();

        $payload = ['remember-me' => true];
        $userSettings = (object)[
            'ip' => '127.0.0.1'
        ];

        $business = new RememberBusiness();
        $token = $business->createTokenRemember($payload, $user, $userSettings);

        $this->assertNotEmpty($token);

        $remember = $this->rememberModel->where('user_id', $user->getId())->first();
        $this->assertNotNull($remember);
        $this->assertEquals($token, $remember->getToken());
    }

    public function testIsRememberTokenValidSuccess()
    {
        $user = $this->createFakeUser();

        $payload = ['remember-me' => true];
        $userSettings = (object)['ip' => '127.0.0.1'];

        $business = new RememberBusiness();
        $token = $business->createTokenRemember($payload, $user, $userSettings);

        $result = RememberBusiness::isRememberTokenValid($token);

        $this->assertInstanceOf(UserEntity::class, $result);
        $this->assertEquals($user->getId(), $result->getId());
    }

    public function testIsRememberTokenValidFailsWithInvalidToken()
    {
        $result = RememberBusiness::isRememberTokenValid('invalid_token_123');
        $this->assertFalse($result);
    }

    public function testRevokeRememberToken()
    {
        $user = $this->createFakeUser();

        $payload = ['remember-me' => true];
        $userSettings = (object)['ip' => '127.0.0.1'];

        $business = new RememberBusiness();
        $business->createTokenRemember($payload, $user, $userSettings);

        $deleted = RememberBusiness::revokeRememberToken($user->getId());

        $this->assertTrue($deleted);

        $remember = $this->rememberModel->where('user_id', $user->getId())->first();
        $this->assertNull($remember);
    }

    private function createFakeUser(): UserEntity
    {
        $user = new UserEntity();
        $user->fill([
            'name' => 'Test User',
            'email' => uniqid('user').'@example.com',
            'password' => password_hash('123456', PASSWORD_BCRYPT)
        ]);

        $this->usersModel->insert($user);
        $user->setId($this->usersModel->getInsertID());

        return $user;
    }
}
