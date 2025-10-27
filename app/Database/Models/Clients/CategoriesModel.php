<?php

namespace App\Database\Models\Clients;

use App\Traits\ModelTrait;
use CodeIgniter\Model;

class CategoriesModel extends Model
{
    use ModelTrait;

    protected $DBGroup          = 'default';
    protected $table            = 'categories';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Clients\CategoryEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'description'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    
}
