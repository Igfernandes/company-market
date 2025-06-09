<?php

namespace App\Database\Models\Notifications;

use CodeIgniter\Model;

class NotificationsModel extends Model
{
    protected $table            = 'notifications';
    protected $primaryKey       = 'id';
    protected $DBGroup          = 'default';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Notifications\NotificationEntity';
    protected $protectFields    = true;

    protected $allowedFields = [
        'title',
        'message',
        'action',
        'scope',
        'key',
        'author_id'
    ];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
}
