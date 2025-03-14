<?php

namespace App\Database\Models\Users;

use CodeIgniter\Model;

class GroupsModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'categories';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Users\GroupEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'status', 'description'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
