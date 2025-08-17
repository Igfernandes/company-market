<?php

namespace App\Database\Models\Users;

use App\Database\Entities\Users\UserEntity;
use App\Traits\ModelTrait;
use CodeIgniter\Model;

/**
 * @method UserEntity|null find($id = null)
 * @method UserEntity|null first()
 * @method UserEntity[]|null findAll($limit = 0, $offset = 0)
 */
class UsersModel extends Model
{
    use ModelTrait;

    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Users\UserEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'username', 'email', 'password', 'photo', 'cpf', 'phone', 'birthdate', 'keyword', 'status', 'email_sha256', 'phone_sha256', 'cpf_sha256', 'twof_secret', 'system_key', 'created_at', 'updated_at'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
