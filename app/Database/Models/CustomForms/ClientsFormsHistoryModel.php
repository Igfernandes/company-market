<?php

namespace App\Database\Models\CustomForms;

use CodeIgniter\Model;

class ClientsFormsHistoryModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'clients_forms_history';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\CustomForms\ClientFormHistoryEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['form_id', 'client_id', 'package'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
}
