<?php

namespace App\Database\Models\Reports;

use App\Traits\ModelTrait;
use CodeIgniter\Model;

class OperationFailuresModel extends Model
{
    use ModelTrait;

    protected $DBGroup          = 'default';
    protected $table            = 'operation_failures';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Reports\OperationFailureEntity';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'operation_type',
        'provider',
        'error_message',
        'error_code',
        'payload_sent',
        'response_received',
        'attempt_number',
        'should_retry',
        'status',
        'resolved_at'
    ];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
