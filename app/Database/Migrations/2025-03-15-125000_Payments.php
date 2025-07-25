<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Payments extends Migration
{
    protected $tb_name = "payments";

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'payment_id' => [
                'type' => 'VARCHAR(100)',
                'null' => true
            ],
            'paid_amount' => [
                'type' => 'DECIMAL(10,2)',
                'null' => true
            ],
            'client_id' => [
                'type' => 'INT',
                'null' => true,
                'unsigned' => true
            ],
            'charge_id' => [
                'type' => 'INT',
                'unsigned' => true
            ],
            'bank_id' => [
                'type' => 'INT',
                'unsigned' => true
            ],
            'status' => [
                'type' => 'ENUM("PAID", "PENDING", "CANCELED")'
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey("bank_id", "integrations", ["id"]);
        $this->forge->addForeignKey("charge_id", "charges", ["id"]);
        $this->forge->addForeignKey("client_id", "clients", ["id"]);
        $this->forge->createTable($this->tb_name, true);
    }

    public function down()
    {
        $this->forge->dropTable($this->tb_name);
    }
}
