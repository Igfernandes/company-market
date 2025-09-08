<?php

namespace App\Api\Operations\Users\Get;

use App\Business\Users\UsersBusiness;
use App\Business\Users\UserSingleBusiness;
use App\Database\Entities\Users\UserEntity;
use App\Database\Models\Users\UsersRolesModel;
use App\Libraries\Exceptions\Exceptions;
use App\Traits\Users\UsersDataTrait;
use CodeIgniter\HTTP\ResponseInterface;

class GetUseCases
{
    use UsersDataTrait;

    private UserSingleBusiness $userSingleBusiness;
    private UsersBusiness $usersBusiness;

    public function __construct()
    {
        $this->userSingleBusiness =  new UserSingleBusiness();
        $this->usersBusiness = new UsersBusiness();
    }
    /**
     * @param array{
     *     current: string, 
     *     id: int,
     *     in_ids: array<int>, 
     *     name: string, 
     *     cpf: string, 
     *     phone: string, 
     *     birthdate: string, 
     *     status: 'ACTIVE' | 'INACTIVE', 
     *     limit: integer|undefined;
     *     start: integer|undefined;
     * } $payload
     */
    public function execute(array $payload)
    {
        $filteredFields = \array_filter($payload, fn($field) => !empty($field));

        $session = session();
        $usersRolesModel = new UsersRolesModel();
        $userEntity = new UserEntity();
        $userEntity->store($filteredFields);

        /** @var UserEntity */
        $userAuth = $session->get(SESSION_KEY_AUTH_USER);

        if (isset($payload['id'])) {
            $userEntity->setId($payload['id']);
        }

        if (isset($payload['current'])) {
            $userEntity->setId($userAuth->getId());
        }

        $limit = isset($payload['limit']) ? \intval($payload['limit']) : 50;
        $startIndexRegister = isset($payload['start']) ? \intval($payload['start']) : 0;

        $foundUserRole = $usersRolesModel->where("deleted_at", null)->limit($limit, $startIndexRegister)->getUsersWithRole($userEntity->toArray(true));
        /** @var array{UserEntity} */
        $users = [];

        foreach ($foundUserRole as $userRole) {
            $users[$userRole->getUserId()] = $userRole->getUser();
        }

        $users = \array_values($users);

        if (count($users) == 0 && isset($filteredFields['id']))
            throw new Exceptions("Api.users.invalid.not_found", ResponseInterface::HTTP_NOT_FOUND);

        if (count($users) == 0 && isset($filteredFields['current']))
            throw new Exceptions("Api.users.invalid.not_found", ResponseInterface::HTTP_UNAUTHORIZED);

        if (isset($filteredFields['id']) || isset($filteredFields['current']))
            return $this->builder($users[0], $foundUserRole);

        return array_map(fn(UserEntity $user) => $this->builder($user, $foundUserRole), $users);
    }
}
