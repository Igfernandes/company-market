<?php

/**
 * @package Register
 * - Referente ao registro de usuários.
 */

namespace App\Business;

trait BaseBusiness
{
    protected function lang($param)
    {
        $session = session();
        $LANGUAGE = $session->get("language");

        return lang($param, [$LANGUAGE]);
    }
}
