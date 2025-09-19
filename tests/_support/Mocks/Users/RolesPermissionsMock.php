<?php

namespace Tests\Support\Mocks\Users;

use App\Database\Models\Permissions\RolesPermissionsModel;
use App\Database\Models\Users\RolesModel;
use CodeIgniter\Test\CIUnitTestCase;

class RolesPermissionsMock extends CIUnitTestCase
{
    const DATA = [
        [
            'role_id' => 4,
            'ids'    => [1, 2, 3]
        ],

    ];

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        $rolesModel = new RolesModel();
        $rolesModel->insert([
            'id'            => 4,
            'name'          => 'Comerciantes',
            'description'   => 'A função de usuário excluídos.',
            'permissions'   => [1, 2, 3]
        ]);

        $rolesPermissionsModel = new RolesPermissionsModel();
        foreach (SELF::DATA as $role) {
            $rolesPermissionsModel->insert($role); // só funciona com id manual se auto-increment não estiver ativo
        }
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
        // 🔹 Executa uma vez depois de todos os testes
        // Ex: dropar tabelas, limpar arquivos temporários

        $rolesModel = new RolesModel();
        $rolesModel->delete(4);

        $rolesPermissionsModel = new RolesPermissionsModel();
        $rolesPermissionsModel->where("role_id", 4)->delete();
    }
}
