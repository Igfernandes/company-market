<?php

namespace App\Database\Models\Users;

use CodeIgniter\Model;

class UsersCategoriesModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users_categories';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Users\UserCategoryEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['category_id', 'user_id'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
}
