<?php

namespace App\Database\Models\Subscribes;

use App\Traits\ModelTrait;
use CodeIgniter\Model;

class SubscribesModel extends Model
{
    use ModelTrait;
    
    protected $DBGroup          = 'default';
    protected $table            = 'subscribes';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Subscribes\SubscribeEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['phone_sha256', 'type', 'data'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
}
