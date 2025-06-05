<?php

namespace App\Database\Models\Reports;

use App\Traits\ModelTrait;
use CodeIgniter\Model;

class SettingsHistoryModel extends Model
{
    use ModelTrait;

    protected $DBGroup          = 'default';
    protected $table            = 'settings_history';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Reports\PaymentEntity';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'module',
        'operation',
        'payload',
        'status',
    ];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
