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
        $this->call('App\Database\Seeds\Permissions\PermissionsSeeder');
        $this->call('App\Database\Seeds\Permissions\RolesPermissionsSeeder');
        $this->call('App\Database\Seeds\Clients\CategoriesSeeder');
    }
}
