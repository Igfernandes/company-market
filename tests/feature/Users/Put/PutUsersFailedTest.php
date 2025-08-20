<?php

namespace Tests\Feature\Users\Put;

use App\Business\Users\UsersBusiness;
use App\Database\Models\Users\UsersModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Mocks\Notifications\NotificationsMock;
use Tests\Support\Sessions\AuthenticatedSession;

class PutUsersFailedTest extends NotificationsMock
{
    use FeatureTestTrait, AuthenticatedSession;

    private string $route = '/api/users';
    const PAYLOAD =  [
        'id' => 2, // id inexistente
        'name' => 'Teste',
        'phone' => '11999999999',
        'password' => 'Aa@134',
        'email' => 'teste@companymarketbr.com.br',
        'birthdate' => '1990-01-01',
        'document' => '12345678900',
        'email' => 'teste@example.com',
        'keyword' => 'abc123'
    ];

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        $usersBusiness  = new UsersBusiness();
        $encryptedKey = SELF::PAYLOAD['password'] . ":" . SELF::PAYLOAD['email'];
        $usersBusiness->store(SELF::PAYLOAD, $encryptedKey);
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();

        $usersModel  = new UsersModel();
        $usersModel->delete(SELF::PAYLOAD['id']);
    }

    /**
     * Cenário: payload inválido causa exceção
     */
    public function testReturnErrorByIdIncorrect()
    {
        $this->createAuthenticatedSession(2);

        $payload = SELF::PAYLOAD;
        unset($payload['id']);

        $result = $this->withBody(json_encode($payload), 'application/json')->put("{$this->route}/999");

        $result->assertStatus(ResponseInterface::HTTP_NOT_ACCEPTABLE);
    }

    public function testReturnErroNotAvailablePhone()
    {
        $this->createAuthenticatedSession(1);

        $payload = SELF::PAYLOAD;
        unset($payload['id']);

        $result = $this->withBody(json_encode($payload), 'application/json')->put($this->route);

        $result->assertJSONFragment([
            "error" => "Api.users.invalid.already_exists_phone"
        ]);
        $result->assertStatus(ResponseInterface::HTTP_NOT_ACCEPTABLE);
    }

    public function testReturnErroNotAvailableDocument()
    {
        $this->createAuthenticatedSession(1);

        $payload = SELF::PAYLOAD;
        $payload['phone'] = '123456789';
        $payload['email'] = 'availableemail@companymarketbr.br';
        unset($payload['id']);

        $result = $this->withBody(json_encode($payload), 'application/json')->put($this->route);

        $result->assertJSONFragment([
            "error" => "Api.users.invalid.already_exists_document"
        ]);
        $result->assertStatus(ResponseInterface::HTTP_NOT_ACCEPTABLE);
    }

    public function testReturnErroNotAvailableEmail()
    {
        $this->createAuthenticatedSession(1);

        $payload = SELF::PAYLOAD;
        $payload['phone'] = '123456789';
        unset($payload['id']);

        $result = $this->withBody(json_encode($payload), 'application/json')->put($this->route);

        $result->assertJSONFragment([
            "error" => "Api.users.invalid.already_exists_email"
        ]);
        $result->assertStatus(ResponseInterface::HTTP_NOT_ACCEPTABLE);
    }
}
