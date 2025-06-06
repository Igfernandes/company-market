<?php

namespace App\Business\Payments;

use App\Business\BaseBusiness;
use App\Database\Models\Finances\PaymentsModel;

class PaymentsBusiness
{
    use BaseBusiness;
    private PaymentsModel $paymentsModel;

    public function __construct()
    {
        $this->paymentsModel = new PaymentsModel();
    }

    public function has($query): bool
    {
        $founds = $this->paymentsModel->where($query)->find();

        return !empty($founds);
    }
}
