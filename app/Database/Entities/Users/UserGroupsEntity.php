<?php

namespace App\Database\Entities\Users;

use CodeIgniter\Entity\Entity;

class UserGroupsEntity extends Entity
{
    protected $dates = [];
    public $attributes = [
        'group_id'        => null,
        'group'           => null,
        'user_id'         => null,
        'user'            => null,
        "created_at"      => null,
        "updated_at"      => null
    ];
    public $relations = [
        'group'     => null,
        'user'      => null
    ];

    /**
     * getGroupId function
     *
     * @return Int|null
     */
    public function getGroupId(): ?Int
    {
        return $this->attributes['group_id'];
    }

    /**
     * setGroupId function
     *
     * @param Int|null $groupId
     * @return void
     */
    public function setGroupId(Int $groupId)
    {
        if (!empty($groupId))
            $this->attributes['group_id'] = $groupId;
    }

    /**
     * getGroup function
     *
     * @return GroupsEntity|null
     */
    public function getGroup(): ?GroupEntity
    {
        return $this->relations['group'];
    }

    /**
     * setGroup function
     *
     * @param GroupsEntity|null $user
     * @return void
     */
    public function setGroup(GroupEntity $group)
    {
        if (!empty($group))
            $this->relations['group'] = $group;
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
        return $this->relations['user'];
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
            $this->relations['user'] = $user;
    }

    /**
     * setExpiredAt function
     *
     * @param String|null $createdAt
     * @return void
     */
    public function setExpiredAt(?String $expiredAt)
    {
        if (!empty($expiredAt))
            $this->attributes['expired_at'] = $expiredAt;
    }

    /**
     * getExpiredAt function
     *
     * @return String|null
     */
    public function getExpiredAt(): ?String
    {
        return $this->attributes['expired_at'];
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
            $this->attributes['created_at'] = $createdAt;
    }

    /**
     * getCreatedAt function
     *
     * @return String|null
     */
    public function getCreatedAt(): ?String
    {
        return $this->attributes['created_at'];
    }

    /**
     * setUpdatedAt function
     *
     * @param String|null $updatedAt
     * @return void
     */
    public function setUpdatedAt(?String $updatedAt)
    {
        if (!empty($updatedAt))
            $this->attributes['updated_at'] = $updatedAt;
    }

    /**
     * getUpdatedAt function
     *
     * @return String|null
     */
    public function getUpdatedAt(): ?String
    {
        return $this->attributes['updated_at'];
    }
}
