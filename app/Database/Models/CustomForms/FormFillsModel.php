<?php

namespace App\Database\Models\CustomForms;

use CodeIgniter\Model;

class FormFillsModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'form_fills';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\CustomForms\FormFillEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['form_id', 'field_id',  'package', 'value'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
}
