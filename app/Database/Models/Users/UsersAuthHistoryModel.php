<?php

namespace App\Database\Models\Users;

use App\Database\Entities\Users\UserAuthHistoryEntity;
use App\Database\Entities\Users\UserEntity;
use App\Traits\ModelTrait;
use CodeIgniter\Model;

class UsersAuthHistoryModel extends Model
{
    use ModelTrait;

    protected $DBGroup          = 'default';
    protected $table            = 'users_auth_history';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Users\UserAuthHistoryEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'ip', 'browser'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';

    public function getUserAuthHistoryAndUser(Object|array $where)
    {
        $foundUserAuthHistories = $this->where($where)->join("users", "users.id = users_auth_history.user_id")->findAll();

        $foundUserAuthHistoriesOrganized = array_map(function (UserAuthHistoryEntity $userAuthHistory) {
            $userAuthHistoryEntity = new UserAuthHistoryEntity();
            $usersEntity = new UserEntity();

            $userAuthHistoryEntity->setId($userAuthHistory->getId());
            $userAuthHistoryEntity->setBrowser($userAuthHistory->getBrowser());
            $userAuthHistoryEntity->setIp($userAuthHistory->getId());
            $userAuthHistoryEntity->setUserId($userAuthHistory->getUserId());

            $usersEntity->fill($userAuthHistory->toArray());

            $userAuthHistoryEntity->setUser($usersEntity);

            return $userAuthHistoryEntity;
        }, $foundUserAuthHistories);

        return $foundUserAuthHistoriesOrganized;
    }
}
