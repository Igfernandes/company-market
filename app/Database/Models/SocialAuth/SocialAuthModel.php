<?php

namespace App\Database\Models\SocialAuth;

use CodeIgniter\Model;

class SocialAuthModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'social_auth';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\SocialAuth\SocialAuthEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['type', 'external_id', 'configs', 'user_id'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
