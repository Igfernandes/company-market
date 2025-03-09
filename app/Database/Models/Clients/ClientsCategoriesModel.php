<?php

namespace App\Database\Models\Users;

use CodeIgniter\Model;

class ClientsCategoriesModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'clients_categories';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Clients\ClientCategoryEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['category_id', 'client_id'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
}
