<?php

namespace App\Database\Models\Users;

use App\Traits\ModelTrait;
use CodeIgniter\Model;

class RememberModel extends Model
{
    use ModelTrait;

    protected $DBGroup          = 'default';
    protected $table            = 'remember';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Users\RememberEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'token', 'ip'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
}
