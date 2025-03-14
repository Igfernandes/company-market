<?php

namespace App\Database\Models\Fields;

use CodeIgniter\Model;

class FieldsModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'fields';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Fields\FieldEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'scope', 'component', 'type', 'is_file', 'is_required', 'group_id'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
