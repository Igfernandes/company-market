<?php

namespace App\Traits;

use CodeIgniter\Model;

trait BusinessTrait
{

    public function builderClauseWithContains(array $payload, Model $model)
    {
        foreach ($payload as $fieldKey => $fieldValue) {
            if (strstr($fieldKey, "_contains") !== false) {
                $model->like(\str_replace("_contains", $fieldKey, ""), $fieldValue);
            }
        }

        return $model;
    }
}
