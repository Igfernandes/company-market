<?php

namespace App\Database\Models\Notifications;

use CodeIgniter\Model;

class UsersNotificationsModel extends Model
{
    protected $table            = 'users_notifications';
    protected $primaryKey       = 'id';
    protected $useSoftDeletes   = false;
    protected $returnType       = 'App\Database\Entities\Notifications\UserNotificationEntity';

    protected $allowedFields = [
        'user_id',
        'notification_id',
        'created_at'
    ];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';

    protected $skipValidation = true;
}
