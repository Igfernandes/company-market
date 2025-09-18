<?php

namespace Tests\Support\Mocks\Users;

use App\Database\Models\Users\RolesModel;
use CodeIgniter\Test\CIUnitTestCase;

class RolesMock extends CIUnitTestCase
{
    const DATA = [
        [
            'id'            => 4,
            'name'          => 'Serviços Gerais',
            'description'   => 'O grupo de usuários testes',
            'permissions'   => [1, 2, 3]
        ],
        [
            'id'            => 5,
            'name'          => 'Comerciantes',
            'description'   => 'A função de usuário excluídos.',
            'permissions'   => [1, 2, 3]
        ]
    ];

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        $rolesModel = new RolesModel();

        foreach (SELF::DATA as $role) {
            $rolesModel->insert($role); // só funciona com id manual se auto-increment não estiver ativo
        }
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
        // 🔹 Executa uma vez depois de todos os testes
        // Ex: dropar tabelas, limpar arquivos temporários

        $rolesModel = new RolesModel();
        $rolesModel->whereIn(
            "name",
            array_map(fn($role) =>  $role['name'], SELF::DATA)
        )->delete();
    }
}
