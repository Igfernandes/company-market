<?php

namespace App\Database\Models\Permissions;

use CodeIgniter\Model;

class GroupsPermissionsModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'groups_permissions';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Permissions\GroupPermissionsEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['group_id', 'permission_id'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
}
