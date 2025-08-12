<?php

namespace Tests\Integration\Business;

use App\Business\Authentication\AuthenticationBusiness;
use App\Database\Entities\Users\RememberEntity;
use App\Database\Models\Users\RememberModel;
use App\Database\Models\Users\UsersModel;
use CodeIgniter\Test\CIUnitTestCase;

class AuthenticationBusinessTest extends CIUnitTestCase
{
    protected AuthenticationBusiness $authBusiness;
    protected UsersModel $userModel;
    protected RememberModel $rememberModel;

    protected function setUp(): void
    {
        parent::setUp();

        $this->authBusiness = new AuthenticationBusiness();
        $this->userModel = new UsersModel();
        $this->rememberModel = new RememberModel();
    }

    public function testCreateTokenRememberCreatesTokenAndSavesToDatabase()
    {
        helper('crypto');
        // 1. Buscar ou criar um usuário válido no banco de testes
        $user = $this->userModel->where('email_sha256', \referenceHash(\getenv('globals.admin.login')))->first();

        // 2. Criar payload com remember-me ativado
        $payload = ['remember-me' => true];

        // 3. Chamar o método a testar
        $token = $this->authBusiness->createTokenRemember($payload, $user);

        // 4. Verificar se retornou token
        $this->assertNotEmpty($token);
        $this->assertIsString($token);

        // 5. Verificar se o token está salvo no banco (tabela de remember)
        /** @var RememberEntity */
        $record = $this->rememberModel->where('token', $token)->first();
        $this->assertNotNull($record);

        // 6. Verificar se o token está associado ao usuário correto
        $this->assertEquals($user->getId(), $record->getUserId());
    }
}
