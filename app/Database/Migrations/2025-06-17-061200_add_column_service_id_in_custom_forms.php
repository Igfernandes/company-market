<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnServiceIdInCustomForms extends Migration
{
    protected $tb_name = "custom_forms";

    public function up()
    {
        $this->forge->addColumn($this->tb_name, [
            'service_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'after'    => 'status',
                'null'     => true, // ou false, dependendo da regra de negócio
            ],
        ]);

        $this->db->query("ALTER TABLE {$this->tb_name} ADD CONSTRAINT fk_service_id FOREIGN KEY (service_id) REFERENCES services(id)");
    }

    public function down()
    {
        $this->forge->dropColumn($this->tb_name, 'service_id');
    }
}
