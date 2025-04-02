<?php

namespace App\Database\Models\Fields;

use CodeIgniter\Model;

class FieldsGroupsModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'fields_groups';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Fields\FieldsGroupEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'scope'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
}
