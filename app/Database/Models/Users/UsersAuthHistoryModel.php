<?php

namespace App\Database\Models\Users;

use CodeIgniter\Model;

class UsersAuthHistoryModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users_auth_history';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Users\UserAuthHistoryEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'ip', 'broswer'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
}
