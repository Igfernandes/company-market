<?php

namespace App\Database\Models\Users;

use CodeIgniter\Model;

class UsersGroupsModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users_groups';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Users\UserGroupEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['group_id', 'user_id'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
}
