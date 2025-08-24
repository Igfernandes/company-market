<?php

namespace App\Components\Private\Layouts\QuickActions;

use App\Components\BaseComponents;

class QuickActions extends BaseComponents
{
    const ORIGIN = "components/private/layouts/quickActions";
    const PROPS = [
        'actions',
        'export',
        'trash',
        'isReturn'
    ];

    /**
     * @param array{
     *  text: string,
     *  link: string,
     *  class: ?string ,
     *  attributes: ?array 
     * } $actions
     * @param array{
     *  entity: string,
     *  excel: bool,
     *  pdf: bool
     * } $exports
     * @param string $trash O link referente a lixeira dos registros, o que estarão em estado de deleted_at
     */
    public static function render(
        ?array $actions = [],
        ?array $export = [],
        ?string $trash = '',
        ?bool $isReturn = false
    ) {
        return Component(SELF::ORIGIN, compact(SELF::PROPS), $isReturn);
    }
}
