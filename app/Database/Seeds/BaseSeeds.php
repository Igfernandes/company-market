<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BaseSeeds extends Seeder
{
    public function run()
    {
        $this->call('App\Database\Seeds\Users\UsersSeeder');
        $this->call('App\Database\Seeds\Users\RolesSeeder');
        $this->call('App\Database\Seeds\Users\UsersRolesSeeder');
        // $this->call('App\Database\Seeds\Users\UsersFieldsSeeder');
        $this->call('App\Database\Seeds\Users\SettingsPrivacySeeder');
        // $this->call('App\Database\Seeds\Permissions\PermissionsSeeder');
        // $this->call('App\Database\Seeds\Permissions\GroupsPermissionsSeeder');
        // $this->call('App\Database\Seeds\Fields\FieldsGroupsSeeder');
        // $this->call('App\Database\Seeds\Integrations\IntegrationsSeeder');
    }
}
