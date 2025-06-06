<?php

namespace App\Database\Seeds\Integrations;

use App\Database\Entities\Integrations\IntegrationEntity;
use App\Libraries\Crypto\Crypto;
use CodeIgniter\Database\Seeder;

class IntegrationsSeeder extends Seeder
{
    public function run()
    {
        $integrations = [
            "MERCADO_PAGO" => [
                "id" => 1,
                "logotype" => \base_url('/img/mercado-pago-logo.png'),
                "status" => "INACTIVE",
                "type" => "BANK"
            ],
            "FACEBOOK" => [
                "id" => 2,
                "logotype" => \base_url('/img/facebook-logo.png'),
                "status" => "INACTIVE",
                "type" => "CHAT"
            ],
            "INSTAGRAM" => [
                "id" => 3,
                "logotype" => \base_url('/img/instagram-logo.png'),
                "status" => "INACTIVE",
                "type" => "CHAT"
            ],
            "WHATSAPP" => [
                "id" => 4,
                "logotype" => \base_url('/img/whatsapp-logo.png'),
                "status" => "INACTIVE",
                "type" => "CHAT"
            ]
        ];

        $cryptoLibrary = new Crypto();

        foreach ($integrations as $index => $integration) {
            $systemKey = $cryptoLibrary->encrypt($index, getenv('system.encrypted_key'));
            $integrationEntity = new IntegrationEntity();

            $integrationEntity->setSystemKey($systemKey);
            $integrationEntity->setId($integration['id']);
            $integrationEntity->setProvider($index);
            $integrationEntity->setType($integration['type']);
            $integrationEntity->setLogotype($integration['logotype']);
            $integrationEntity->setStatus($integration['status']);

            $prefix = getenv('database.default.DBPrefix');

            $data = array_filter($integrationEntity->attributes, fn($attribute) => !empty($attribute));

            // Simple Queries
            $this->db->query(
                "INSERT INTO  " . $prefix . "integrations (" . join(", ", array_keys($data)) . ") 
            VALUES (" . join(", ", array_map(fn($column) =>  ":$column:", array_keys($data))) . ") 
            ON DUPLICATE KEY UPDATE " . join(", ", array_map(fn($column) =>  "$column = values($column)", array_keys($data))),
                $data
            );
        }
    }
}
