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
    protected $allowedFields    = ['name', 'avatar', 'phone', 'email', 'birthdate', 'status', 'phone_sha256', 'document', 'document_type', 'system_key', 'owner_id', 'company_id', 'deleted_at'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $useSoftDeletes = true;
    protected $deletedField   = 'deleted_at';
}
