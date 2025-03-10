<?php

namespace App\Database\Models\Clients;

use CodeIgniter\Model;

class ClientsModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'clients';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Clients\ClientEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'avatar', 'phone', 'birthdate', 'status', 'phone_sha1', 'system_key', 'owner_id'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
