<?php

namespace App\Database\Models\Integrations;

use App\Traits\ModelTrait;
use CodeIgniter\Model;

class IntegrationsModel extends Model
{
    use ModelTrait;

    protected $DBGroup          = 'default';
    protected $table            = 'integrations';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Integrations\IntegrationEntity';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'provider',
        'type',
        'settings',
        'status',
        'system_key',
        'company_id'
    ];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
}
