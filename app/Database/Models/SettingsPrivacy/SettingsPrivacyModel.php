<?php

namespace App\Database\Models\SettingsPrivacy;

use CodeIgniter\Model;

class SettingsPrivacyModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'settings_privacy';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\SettingsPrivacy\SettingPrivacyEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['title', 'describe', 'path'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
}
