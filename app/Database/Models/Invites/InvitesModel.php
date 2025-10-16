<?php

namespace App\Database\Models\Invites;

use CodeIgniter\Model;

class InvitesModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'invites';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Invites\InviteEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['token', 'type', 'data', 'is_valid', 'email_sha256', 'owner_id', 'expired_at'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
}
