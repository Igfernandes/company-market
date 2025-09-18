<?php

namespace Tests\Integration\Business\UsersBusiness;

use App\Business\Users\UsersBusiness;
use App\Database\Entities\Users\UserEntity;
use App\Database\Models\Users\UsersModel;
use CodeIgniter\Test\CIUnitTestCase;

class UsersBusinessSuccessTest extends CIUnitTestCase
{
    protected $namespace = 'App';

    private UsersBusiness $business;
    private UsersModel $model;

    const USER_MOCK =  [
        'id' => 2, // id inexistente
        'name' => 'Teste',
        'avatar' => 'http://localhost/public/avatar.png',
        'phone' => '11999999999',
        'password' => 'Aa@134',
        'email' => 'teste@companymarketbr.com.br',
        'birthdate' => '1990-01-01',
        'document' => '12345678900',
        'document_type' => 'cpf',
        'keyword' => 'abc123'
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->business = new UsersBusiness();
        $this->model = new UsersModel();
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();

        $usersModel  = new UsersModel();
        $usersModel->delete(SELF::USER_MOCK['id']);
    }
    public function testShouldStoreUser()
    {
        $encryptedKey = SELF::USER_MOCK['password'] . ":" . SELF::USER_MOCK['email'];
        $savedUser = $this->business->store(SELF::USER_MOCK, $encryptedKey);

        $insertUser = $this->model
            ->where('id', $savedUser->getId())
            ->first();

        $this->assertInstanceOf(UserEntity::class, $insertUser);

        $this->assertSame(SELF::USER_MOCK['id'], $insertUser->getId());
        $this->assertSame(SELF::USER_MOCK['name'], $insertUser->getName());
        $this->assertSame(SELF::USER_MOCK['avatar'], $insertUser->getAvatar());
        $this->assertSame(SELF::USER_MOCK['birthdate'], $insertUser->getBirthdate());
        $this->assertSame(SELF::USER_MOCK['document'], $insertUser->getDecryptDocument());
        $this->assertSame(SELF::USER_MOCK['document_type'], $insertUser->getDocumentType());
        $this->assertSame(SELF::USER_MOCK['email'], $insertUser->getDecryptEmail());
        $this->assertSame(SELF::USER_MOCK['keyword'], $insertUser->getDecryptKeyword());
        $this->assertSame(SELF::USER_MOCK['phone'], $insertUser->getDecryptPhone());
    }

    public function testReturnUserExistInHasUserMethod()
    {
        $foundUser = $this->business->hasUser([
            'id' => SELF::USER_MOCK['id']
        ]);

        $this->assertInstanceOf(UserEntity::class, $foundUser);
        $this->assertSame(SELF::USER_MOCK['id'], $foundUser->getId());
    }

    public function testShouldAvailablePhone()
    {
        $isPhoneAvailable = $this->business->isPhoneAvailable("21600635492", SELF::USER_MOCK['id']);

        $this->assertTrue($isPhoneAvailable);
    }

    public function testShouldNotAvailablePhone()
    {
        $isPhoneAvailable = $this->business->isPhoneAvailable(\getenv("globals.admin.phone"), SELF::USER_MOCK['id']);

        $this->assertNotTrue($isPhoneAvailable);
    }

    public function testShouldAvailableDocument()
    {
        $isDocumentAvailable = $this->business->isDocumentAvailable("21600635492", SELF::USER_MOCK['id']);

        $this->assertTrue($isDocumentAvailable);
    }

    public function testShouldAvailableEmail()
    {
        $isEmailAvailable = $this->business->isEmailAvailable("companymarket123@gmail.com", SELF::USER_MOCK['id']);

        $this->assertTrue($isEmailAvailable);
    }

    public function testShouldNotAvailableEmail()
    {
        $isEmailAvailable = $this->business->isEmailAvailable(getenv("globals.admin.login"), SELF::USER_MOCK['id']);

        $this->assertNotTrue($isEmailAvailable);
    }
}
