<?php

namespace App\Database\Models\CustomForms;

use CodeIgniter\Model;

class CustomFormsModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'custom_forms';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\CustomForms\CustomFormEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['page', 'components', 'status', 'target'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
