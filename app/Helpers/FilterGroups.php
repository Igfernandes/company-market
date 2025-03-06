<?php

namespace App\Helpers;

use App\Database\Mappers\Companies\CompaniesMapper;
use App\Database\Mappers\Users\UsersGroupsMapper;

class FilterGroups
{
    /**
     * @method getAll Irá retornar todos os usuários agrupados por seu tipo ou grupo.
     *
     * @return array
     */
    static function getAllUsers()
    {
        $usersGroupsMapper = new UsersGroupsMapper();
        $foundUsersGroups = $usersGroupsMapper->mapper();

        $dataGroups = [];

        foreach ($foundUsersGroups as $usersGroups) {
            if (!isset($dataGroups[$usersGroups->getGroup()->getTitle()]) || !is_array($dataGroups[$usersGroups->getGroup()->getTitle()]))
                $dataGroups[$usersGroups->getGroup()->getTitle()] = [];

            array_push($dataGroups[$usersGroups->getGroup()->getTitle()], $usersGroups);
        };

        return  $dataGroups;
    }

    /**
     * @method getAllCompanies Irá retornar todos as empresas agrupadas por seu tipo ou grupo.
     *
     * @return array
     */
    static function getAllCompanies()
    {
        $companiesMappers = new CompaniesMapper();
        $foundCompanies = $companiesMappers->mapper();

        $dataGroups = [];

        foreach ($foundCompanies as  $company) {
            if (!isset($dataGroups[$company->getType()]) || !is_array($dataGroups[$company->getType()]))
                $dataGroups[$company->getType()] = [];

            $dataGroups[$company->getType()] = $company;
        };

        return $dataGroups;
    }
}
