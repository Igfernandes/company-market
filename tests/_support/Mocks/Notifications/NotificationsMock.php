<?php

namespace Tests\Support\Mocks\Notifications;

use App\Database\Models\Notifications\NotificationsModel;
use CodeIgniter\Test\CIUnitTestCase;

class NotificationsMock extends CIUnitTestCase
{
    const DATA = [
        [
            'title'     => 'Novo Usuário',
            'message'   => 'Um novo usuário foi criado no sistema.',
            'action'    => 'CREATE',
            'scope'     => 'users',
            'key'       => 1,
            'author_id' => 1,
        ],
        [
            'title'     => 'Atualização de clientes',
            'message'   => 'O cliente foi atualizado com sucesso.',
            'action'    => 'UPDATE',
            'scope'     => 'clients',
            'key'       => 2,
            'author_id' => 1,
        ],
        [
            'title'     => 'Permissão Revogada',
            'message'   => 'As permissões do usuário foram revogadas.',
            'action'    => 'DELETE',
            'scope'     => 'permissions',
            'key'       => 3,
            'author_id' => 1,
        ],
        [
            'title'     => 'Novo Charges',
            'message'   => 'Um cliente realizou um novo pedido.',
            'action'    => 'CREATE',
            'scope'     => 'charges',
            'key'       => 4,
            'author_id' => 1,
        ],
        [
            'title'     => 'Formulário atualizado',
            'message'   => 'Um formulário foi atualizado.',
            'action'    => 'UPDATE',
            'scope'     => 'forms',
            'key'       => 5,
            'author_id' => 1,
        ],
    ];
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        $notificationsModel = new NotificationsModel();
        $notificationsModel->insertBatch(SELF::DATA);
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
        // 🔹 Executa uma vez depois de todos os testes
        // Ex: dropar tabelas, limpar arquivos temporários

        // $notificationsModel = new NotificationsModel();
        // $notificationsModel->where("1=1")->delete();
    }
}
