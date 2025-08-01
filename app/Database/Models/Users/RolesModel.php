<?php

namespace App\Database\Models\Users;

use App\Traits\ModelTrait;
use CodeIgniter\Model;

class RolesModel extends Model
{
    use ModelTrait;

    protected $DBGroup          = 'default';
    protected $table            = 'roles';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Users\RoleEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'status', 'description'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
