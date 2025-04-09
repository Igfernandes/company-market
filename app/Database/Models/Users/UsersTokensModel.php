<?php

namespace App\Database\Models\Users;

use App\Database\Entities\Users\UserEntity;
use App\Database\Entities\Users\UserTokenEntity;
use App\Traits\ModelTrait;
use CodeIgniter\Model;

class UsersTokensModel extends Model
{
    use ModelTrait;

    protected $DBGroup          = 'default';
    protected $table            = 'users_tokens';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Users\UserTokenEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['token', 'operation', 'path', 'accessibility', 'data', 'is_valid', 'expired_at', 'user_id'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getTokenWithUser(array $usersQuery, array $tokensQuery = []): array
    {
        $usersQueryUpdated = $this->addPrefixInQuery($usersQuery, "users");
        $tokensQueryUpdated = $this->addPrefixInQuery($tokensQuery, "users_tokens");

        $inUserIds = isset($usersQuery['in_ids']) ? $usersQuery['in_ids'] : [];
        unset($usersQuery['in_ids']);

        if (count($inUserIds) > 0)
            $this->whereIn("user_id", $inUserIds);

        $inTokensIds = isset($tokensQuery['in_ids']) ? $tokensQuery['in_ids'] : [];
        unset($tokensQuery['in_ids']);

        if (count($inTokensIds) > 0)
            $this->whereIn("users_tokens.id", $inTokensIds);

        $founds = $this->Select("users.*, users_tokens.*,
        users.name as user_name, users.id as user_id, users.created_at as user_created_at, 
        users.updated_at as user_updated_at,
        users_tokens.id as token_id, users_tokens.created_at as token_created_at,
        users_tokens.updated_at as token_updated_at")
            ->join("users", "users.id = users_tokens.user_id")
            ->where($usersQueryUpdated)
            ->where($tokensQueryUpdated)->findAll();

        return array_map(function (UserTokenEntity $userTokenData) {
            $userTokenEntity = new UserTokenEntity();
            $userEntity = new UserEntity();

            /** @var array */
            $attributes = $userTokenData->attributes;

            $userEntity->store($attributes);
            $userEntity->setId($attributes['user_id']);
            $userEntity->setName($attributes['user_name']);
            $userEntity->setCreatedAt($attributes['user_created_at']);
            $userEntity->setUpdatedAt($attributes['user_updated_at']);

            $userTokenEntity->store($attributes);
            $userTokenEntity->setId($attributes['token_id']);
            $userTokenEntity->setCreatedAt($attributes['token_created_at']);
            $userTokenEntity->setUpdatedAt($attributes['token_updated_at']);

            $userTokenEntity->setUserId($attributes['user_id']);
            $userTokenEntity->setUser($userEntity);

            return $userTokenEntity;
        }, $founds);
    }
}
