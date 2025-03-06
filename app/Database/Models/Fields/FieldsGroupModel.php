<?php

namespace App\Database\Models\Fields;

use CodeIgniter\Model;

class FieldsGroupModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'fields_group';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Fields\FieldGroupEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'position', 'field_id'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
}
