<?php

namespace App\Database\Models\Users;

use CodeIgniter\Model;

class UsersTokensModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users_tokens';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Users\UserTokenEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['operation', 'path', 'accessibility', 'data', 'is_valid', 'expired_at', 'user_id'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
