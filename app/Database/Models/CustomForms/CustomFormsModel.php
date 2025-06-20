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
    protected $allowedFields    = ['name', 'slug', 'description', 'components', 'status', 'service_id', 'started_at', 'expired_at'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
