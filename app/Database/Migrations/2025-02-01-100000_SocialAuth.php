<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SocialAuth extends Migration
{
    protected $tb_name = "social_auth";

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'type' => [
                'type' => 'ENUM("GOOGLE", "FACEBOOK")'
            ],
            'external_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '150'
            ],
            'email' => [
                'type'   => 'VARCHAR',
                'constraint' => '400'
            ],
            'config' => [
                'type' => 'JSON',
            ],
            'user_id' => [
                'type' => 'INT'
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addForeignKey("user_id", "users", ["id"]);
        $this->forge->addKey('id', true);

        $this->forge->createTable($this->tb_name);
    }

    public function down()
    {
        $this->forge->dropTable($this->tb_name);
    }
}
