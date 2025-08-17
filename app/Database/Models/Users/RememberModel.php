<?php

namespace App\Database\Models\Users;

use App\Database\Entities\Users\RememberEntity;
use App\Traits\ModelTrait;
use CodeIgniter\Model;

/**
 * @method RememberEntity|null find($id = null)
 * @method RememberEntity|null first()
 * @method RememberEntity[]|null findAll($limit = 0, $offset = 0)
 */
class RememberModel extends Model
{
    use ModelTrait;

    protected $DBGroup          = 'default';
    protected $table            = 'remember';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Users\RememberEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'ip','token'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
}
