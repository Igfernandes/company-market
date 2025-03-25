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
    protected $allowedFields    = ['name', 'type', 'description', 'status', 'privacy', 'stock', 'reservations', 'photo'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
