<?php

namespace App\Business\Services;

use App\Business\BaseBusiness;
use App\Database\Entities\Services\ServiceRuleEntity;
use App\Database\Models\Services\ServicesRulesModel;
use DateInterval;
use DateTime;

class ServicesRulesBusiness
{
    use BaseBusiness;

    private ServicesRulesModel $servicesRulesModel;

    public function __construct()
    {
        $this->servicesRulesModel = new ServicesRulesModel();
    }

    public function gratuity(int $serviceId, int $gratuity)
    {
        if (empty($gratuity) || empty($serviceId))
            return;

        $date = new DateTime();
        $date->sub(new DateInterval("P{$gratuity}Y"));

        /** @var ServiceRuleEntity */
        $rule = $this->servicesRulesModel->where(["service_id" => $serviceId, "label" => "gratuity"])->first();

        if (!empty($rule)) {
            return  $this->servicesRulesModel
                ->set("condition", "birthdate <= '" . $date->format("Y-m-d") . "'")
                ->where([
                    "id" => $rule->getId()
                ])->update();
        }

        $this->servicesRulesModel->save([
            "service_id" => $serviceId,
            "label" => "gratuity",
            "column" => "stock",
            "value" => $gratuity,
            "condition" => "birthdate >= '" . $date->format("Y-m-d") . "'"
        ]);
    }
}
