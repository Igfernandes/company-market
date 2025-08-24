<?php

namespace Tests\Feature\Users\Delete;

use App\Business\Users\UsersBusiness;
use App\Database\Models\Users\UsersModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Mocks\Notifications\NotificationsMock;
use Tests\Support\Sessions\AuthenticatedSession;

class DeleteUsersSuccessTest extends NotificationsMock
{
    use FeatureTestTrait, AuthenticatedSession;

    private string $route = '/api/users';
    const PAYLOAD =  [
        'id' => 3, // id inexistente
        'name' => 'Teste Delete',
        'phone' => '11999999998',
        'password' => 'Aa@134',
        'email' => 'teste_delete@companymarketbr.com.br',
        'birthdate' => '1990-01-01',
        'document' => '12345678999',
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
    public function testDeleteUser()
    {
        $this->createAuthenticatedSession(1);

        $payload = SELF::PAYLOAD;

        $result = $this->delete("{$this->route}/" . $payload['id']);

        $result->assertJSONFragment([
            "success" => "Api.users.success.delete"
        ]);
        $result->assertStatus(ResponseInterface::HTTP_OK);
    }
}
