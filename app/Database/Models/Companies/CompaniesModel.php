<?php

namespace App\Database\Models\Companies;

use App\Traits\ModelTrait;
use CodeIgniter\Model;

class CompaniesModel extends Model
{
    use ModelTrait;
    protected $DBGroup          = 'default';
    protected $table            = 'companies';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Companies\CompanyEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'avatar', 'phone', 'inscribed_at', 'email', 'status', 'phone_sha256', 'document', 'document_type', 'system_key', 'owner_id', 'deleted_at'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $useSoftDeletes = true;
    protected $deletedField   = 'deleted_at';
}
