<?php

namespace App\Database\Models\Users;

use App\Traits\ModelTrait;
use CodeIgniter\Model;

class GroupsModel extends Model
{
    use ModelTrait;

    protected $DBGroup          = 'default';
    protected $table            = 'groups';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Users\GroupEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'status', 'description'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
