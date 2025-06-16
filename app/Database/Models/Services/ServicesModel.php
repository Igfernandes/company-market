<?php

namespace App\Database\Models\Services;

use CodeIgniter\Model;

class ServicesModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'services';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Services\ServiceEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'description', 'status','stock', 'photo', 'realized_at', 'expired_at', 'address'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
