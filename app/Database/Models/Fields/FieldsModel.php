<?php

namespace App\Database\Models\Fields;

use App\Traits\ModelTrait;
use CodeIgniter\Model;

class FieldsModel extends Model
{
    use ModelTrait;
    protected $DBGroup          = 'default';
    protected $table            = 'fields';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Fields\FieldEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'component', 'type', 'is_required', 'is_sensitive', 'group_id'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
