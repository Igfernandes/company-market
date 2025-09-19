<?php

namespace Tests\Feature\Users\Roles\Put;

use App\Database\Models\Users\RolesModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Mocks\Users\RolesMock;
use Tests\Support\Sessions\AuthenticatedSession;
use Tests\Support\Traits\Users\RolesTrait;

class PutRolesSuccessTest extends RolesMock
{
    use FeatureTestTrait, AuthenticatedSession, RolesTrait;

    private string $route = '/api/users/roles';

    /**
     * Cenário: payload inválido causa exceção
     */
    public function testUpdateRoles()
    {
        $this->createAuthenticatedSession(2);

        $payload = SELF::DATA[0];
        $found = $this->rolesModel->where("name", $payload['name'])->first();
        $id = $found->getId();

        unset($payload['permissions']);

        $result = $this->withBody(json_encode($payload), 'application/json')->put("{$this->route}/" .  $id);

        $result->assertJSONFragment([
            "success" => "Api.roles.success.put"
        ]);
        $result->assertStatus(ResponseInterface::HTTP_OK);
    }
}
