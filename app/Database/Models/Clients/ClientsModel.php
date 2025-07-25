<?php

namespace App\Database\Models\Clients;

use App\Traits\ModelTrait;
use CodeIgniter\Model;

class ClientsModel extends Model
{
    use ModelTrait;
    protected $DBGroup          = 'default';
    protected $table            = 'clients';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Clients\ClientEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'avatar', 'phone', 'email', 'birthdate', 'status', 'email_sha256', 'phone_sha256', 'system_key', 'owner_id'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
