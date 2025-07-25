<?php

namespace App\Interfaces;

interface IPermissions
{
    public function setPermissionId(int $permissionId): void;
    public function toArray(bool $onlyChanged = false, bool $cast = true, bool $recursive = false): array;
}
