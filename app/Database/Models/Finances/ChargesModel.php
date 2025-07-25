<?php

namespace App\Database\Models\Finances;

use App\Traits\ModelTrait;
use CodeIgniter\Model;

class ChargesModel extends Model
{
    use ModelTrait;

    protected $DBGroup          = 'default';
    protected $table            = 'charges';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Finances\ChargeEntity';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'title',
        'description',
        'price',
        'reference',
        'status',
        'amount',
        'privacy',
        'promotional_price',
        'service_id',
        'type',
        'period',
        'expired_days',
        'started_at'
    ];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
