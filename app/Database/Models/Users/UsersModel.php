<?php

namespace App\Database\Models\Users;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Users\UserEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'username', 'email', 'password', 'photo', 'cpf', 'phone', 'birthdate', 'keyword', 'status', 'email_sha1', 'phone_sha1', 'cpf_sha1', 'twof_secret', 'system_key', 'created_at', 'updated_at'];
    protected $useSoftDeletes = true;

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
