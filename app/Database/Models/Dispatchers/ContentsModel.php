<?php

namespace App\Database\Models\Dispatchers;

use CodeIgniter\Model;

class ContentsModel extends Model
{
    protected $table            = 'contents';
    protected $primaryKey       = 'id';
    protected $DBGroup          = 'default';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Dispatchers\ContentEntity';
    protected $protectFields    = true;

    protected $allowedFields = [
        'name',
        'image',
        'description',
        'status',
        'address',
        'realized_at',
        'closed_at'
    ];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
