<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UsersCategories extends Migration
{
    protected $tb_name = "users_categories";

    public function up()
    {
        $this->forge->addField([
            'category_id' => [
                'type' => 'INT'
            ],
            'user_id' => [
                'type' => 'INT'
            ],
            'created_at datetime default current_timestamp'
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey("category_id", "categories", ["id"]);
        $this->forge->addForeignKey("user_id", "users", ["id"]);

        $this->forge->createTable($this->tb_name);
    }

    public function down()
    {
        $this->forge->dropTable($this->tb_name);
    }
}
