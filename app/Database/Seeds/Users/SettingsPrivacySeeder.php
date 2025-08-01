<?php

namespace App\Database\Seeds\Users;

use App\Database\Entities\SettingsPrivacy\SettingPrivacyEntity;
use CodeIgniter\Database\Seeder;

class SettingsPrivacySeeder extends Seeder
{
    public function run()
    {
        $settingsPrivacy = new SettingPrivacyEntity();
        $POLICIES_PRIVACY = [
            "code_of_ethics"  => (object)[
                "id" => 1,
            ],
            "anti_doping_policy" => (object)[
                "id" => 2,
            ],
            "general_data_protection_law" => (object)[
                "id" => 3,
            ]
        ];

        foreach ($POLICIES_PRIVACY as $name => $policyPrivacy) :

            $settingsPrivacy->setId($policyPrivacy->id);
            $settingsPrivacy->setName($name);

            $prefix = getenv('database.default.DBPrefix');

            $data = array_filter($settingsPrivacy->attributes, fn($attribute) => !empty($attribute));

            // Simple Queries
            $this->db->query(
                "INSERT INTO  " . $prefix . "settings_privacy (" . join(", ", array_keys($data)) . ") 
                VALUES (" . join(", ", array_map(fn($column) =>  ":$column:", array_keys($data))) . ") 
                ON DUPLICATE KEY UPDATE " . join(", ", array_map(fn($column) =>  "$column = values($column)", array_keys($data))),
                $data
            );
        endforeach;
    }
}
