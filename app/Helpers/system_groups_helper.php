<?php

use App\Database\Mappers\Companies\CompaniesMapper;
use App\Database\Mappers\Users\UsersGroupsMapper;

if (!function_exists('getUsers')) {
    function getUsers()
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
}

if (!function_exists('getCompanies')) {
    function getCompanies()
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
