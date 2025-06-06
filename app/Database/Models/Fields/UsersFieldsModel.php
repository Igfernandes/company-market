<?php

namespace App\Database\Models\Fields;

use CodeIgniter\Model;

class UsersFieldsModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users_fields';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Fields\UserFieldEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'client_id'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
}
