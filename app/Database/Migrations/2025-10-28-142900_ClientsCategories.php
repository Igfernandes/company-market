<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ClientsCategories extends Migration
{
    protected $tb_name = "clients_categories";

    public function up()
    {
        $this->forge->addField([
            'category_id' => [
                'type' => 'INT',
                'unsigned'       => true,
            ],
            'client_id' => [
                'type' => 'INT',
                'unsigned'       => true
            ],
            'created_at datetime default current_timestamp'
        ]);

        $this->forge->addKey(['category_id', 'client_id'], true);
        $this->forge->addForeignKey("client_id", "clients", ["id"]);
        $this->forge->addForeignKey("category_id", "categories", ["id"]);

        $this->forge->createTable($this->tb_name, true);
    }

    public function down()
    {
        $this->forge->dropTable($this->tb_name);
    }
}
