<?php

namespace App\Database\Models\CustomForms;

use CodeIgniter\Model;

class CustomFormsHistoryModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'custom_forms_history';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\CustomForms\CustomFormHistoryEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['description', 'form_id', 'user_id'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
}
