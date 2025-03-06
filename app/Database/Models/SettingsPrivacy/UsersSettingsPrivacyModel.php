<?php

namespace App\Database\Models\SettingsPrivacy;

use CodeIgniter\Model;

class UsersSettingsPrivacyModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users_settings_privacy';
    protected $primaryKey       = ['user_id', 'settings_privacy_id'];

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\SettingsPrivacy\UserSettingsPrivacyEntity';
    protected $protectFields    = true;
    protected $allowedFields    = [ 'ip', 'browser'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
}
