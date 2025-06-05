<?php

namespace App\Database\Models\Finances;

use App\Traits\ModelTrait;
use CodeIgniter\Model;

class PaymentsModel extends Model
{
    use ModelTrait;

    protected $DBGroup          = 'default';
    protected $table            = 'payments';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Finances\PaymentEntity';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'payment_id',
        'paid_amount',
        'client_id',
        'charge_id',
        'bank_id'
    ];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
