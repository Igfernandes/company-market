<?php

namespace App\Database\Entities\Users;

use App\Database\Migrations\SettingsPrivacy;
use CodeIgniter\Entity\Entity;
use Exception;

class UserSettingPrivacyEntity extends Entity
{
    protected $dates = [];
    public $attributes = [
        'user_id'               => null,
        'settings_privacy_id'   => null,
        'ip'                    => null,
        'browser'               => null,
        'user'                  => null,
        'settings_privacy'      => null,
        'created_at'            => null
    ];

    /**
     * getSettingsPrivacyId function
     *
     * @return Int|null
     */
    public function getSettingsPrivacyId(): ?Int
    {
        return $this->attributes['settings_privacy_id'];
    }

    /**
     * setSettingsPrivacyId function
     *
     * @param Int|null $id
     * @return void
     */
    public function setSettingsPrivacyId(?Int $settings_privacy_id)
    {
        if (!empty($settings_privacy_id))
            $this->attributes['settings_privacy_id'] = $settings_privacy_id;
    }


    /**
     * getSettingsPrivacy function
     *
     * @return SettingsPrivacy|null
     */
    public function getSettingsPrivacy(): ?SettingsPrivacy
    {
        return $this->attributes['settings_privacy'];
    }

    /**
     * setSettingsPrivacy function
     *
     * @param SettingsPrivacy|null $settings_privacy
     * @return void
     */
    public function setSettingsPrivacy(SettingsPrivacy $settings_privacy)
    {
        if (!empty($settings_privacy))
            $this->attributes['settings_privacy'] = $settings_privacy;
    }

    /**
     * getIp function
     *
     * @return String|null
     */
    public function getIp(): ?String
    {
        return $this->attributes['ip'];
    }

    /**
     * setIp function
     *
     * @param String|null $ip
     * @return void
     */
    public function setIp(?String $ip)
    {
        if (!empty($ip))
            $this->attributes['ip'] = $ip;
    }


    /**
     * getBrowser function
     *
     * @return String|null
     */
    public function getBrowser(): ?String
    {
        return $this->attributes['browser'];
    }

    /**
     * setBrowser function
     *
     * @param String|null $browser
     * @return void
     */
    public function setBrowser(?String $browser)
    {
        if (!empty($browser))
            $this->attributes['browser'] = $browser;
    }

    /**
     * getUserId function
     *
     * @return Int|null
     */
    public function getUserId(): ?Int
    {
        return $this->attributes['user_id'];
    }

    /**
     * setUserId function
     *
     * @param Int|null $userId
     * @return void
     */
    public function setUserId(Int $userId)
    {
        if (!empty($userId))
            $this->attributes['user_id'] = $userId;
    }

    /**
     * getUser function
     *
     * @return UsersEntity|null
     */
    public function getUser(): ?UserEntity
    {
        return $this->attributes['user'];
    }

    /**
     * setUser function
     *
     * @param UsersEntity|null $user
     * @return void
     */
    public function setUser(UserEntity $user)
    {
        if (!empty($user))
            $this->attributes['user'] = $user;
    }

    /**
     * setCreatedAt function
     *
     * @param String|null $createdAt
     * @return void
     */
    public function setCreatedAt(?String $createdAt)
    {
        if (!empty($createdAt))
            $this->dates['created_at'] = $createdAt;
    }

    /**
     * getCreatedAt function
     *
     * @return String|null
     */
    public function getCreatedAt(): ?String
    {
        return $this->dates['created_at'];
    }
}
