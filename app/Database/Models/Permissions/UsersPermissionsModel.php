<?php

namespace App\Database\Models\Permissions;

use CodeIgniter\Model;

class UsersPermissionsModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users_permissions';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Permissions\UserPermissionsEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'permission_id'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
}
