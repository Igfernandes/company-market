<?php

namespace App\Database\Models\Integrations;

use App\Traits\ModelTrait;
use CodeIgniter\Model;

class IntegrationChatsModel extends Model
{
    use ModelTrait;

    protected $DBGroup          = 'default';
    protected $table            = 'integration_chats';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Integrations\IntegrationChatEntity';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'type',
        'public_token',
        'private_token',
        'username',
        'login',
        'password',
        'system_key'
    ];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
}
