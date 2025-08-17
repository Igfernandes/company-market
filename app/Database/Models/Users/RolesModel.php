<?php

namespace App\Database\Models\Users;

use App\Database\Entities\Users\RoleEntity;
use App\Traits\ModelTrait;
use CodeIgniter\Model;

/**
 * @method RoleEntity|null find($id = null)
 * @method RoleEntity|null first()
 * @method RoleEntity[]|null findAll($limit = 0, $offset = 0)
 */
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
