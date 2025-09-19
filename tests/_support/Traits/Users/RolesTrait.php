<?php

namespace Tests\Support\Traits\Users;

use App\Database\Models\Users\RolesModel;

trait RolesTrait
{
    private RolesModel $rolesModel;

    public function __construct($param)
    {
        $this->rolesModel = new RolesModel();
        parent::__construct($param);
    }

    public function getId(string $name)
    {
        $found = $this->rolesModel->where("name", $name)->first();
        return $found->getId();
    }
}
