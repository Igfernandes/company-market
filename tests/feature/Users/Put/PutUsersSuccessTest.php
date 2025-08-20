<?php

namespace Tests\Feature\Users\Put;

use App\Business\Users\UsersBusiness;
use App\Database\Models\Users\UsersModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Mocks\Notifications\NotificationsMock;
use Tests\Support\Sessions\AuthenticatedSession;

class PutUsersSuccessTest extends NotificationsMock
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
        $encryptedKey = SELF::PAYLOAD['password'] . ":" . SELF::PAYLOAD['email'];

        $usersBusiness  = new UsersBusiness();
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
    public function testUpdateUserInformationAuthenticated()
    {
        $this->createAuthenticatedSession(2);

        $payload = SELF::PAYLOAD;
        unset($payload['id']);

        $result = $this->withBody(json_encode($payload), 'application/json')->put($this->route);

        $result->assertJSONFragment([
            "success" => "Api.users.success.put"
        ]);
        $result->assertStatus(ResponseInterface::HTTP_OK);
    }

    /**
     * Cenário: payload inválido causa exceção
     */
    public function testUpdateUserInformationById()
    {
        $this->createAuthenticatedSession(2);

        $payload = SELF::PAYLOAD;
        $userId = $payload['id'];
        unset($payload['id']);

        $result = $this->withBody(json_encode($payload), 'application/json')->put("{$this->route}/$userId");

        $result->assertJSONFragment([
            "success" => "Api.users.success.put"
        ]);
        $result->assertStatus(ResponseInterface::HTTP_OK);
    }
}
