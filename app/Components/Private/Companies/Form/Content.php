<?php

namespace App\Components\Private\Companies\Form;

use App\Components\BaseComponents;
use App\Components\Private\Layouts\Container\Container;
use App\Database\Entities\Companies\CompanyEntity;

class Content extends BaseComponents
{
    const ORIGIN = "components/private/companies/form/content";
    const PROPS = [
        'company'
    ];

    public static function render(
        CompanyEntity $company = new CompanyEntity(),
        array $categories = []
    ) {

        return Container::render(
            content: [
                Component(SELF::ORIGIN, compact(SELF::PROPS), true)
            ]
        );
    }
}
