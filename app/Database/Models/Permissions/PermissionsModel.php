<?php

namespace App\Database\Models\Permissions;

use CodeIgniter\Model;

class PermissionsModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'permissions';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Permissions\PermissionEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'type', 'scope'];

    protected $dateFormat    = 'datetime';
}
