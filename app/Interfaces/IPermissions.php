<?php

namespace App\Interfaces;

use CodeIgniter\Entity\Entity;

interface IPermissions extends Entity
{
    public function setPermissionId(int $permissionId): void;
}
