<?php

namespace App\Api\Finances\Checkout\Post;

use App\Business\Charges\ChargesBusiness;
use App\Business\Clients\ClientsBusiness;
use App\Libraries\Exceptions\Exceptions;

class PostUseCases
{
    /**
     * @param array{
     *   name: string,
     *   amount: array{int},
     *   product: string,
     *   birthdate: string|null,
     *   phone: string,
     *   email: string|null,
     *   
     * } $payload
     */
    public function execute(array $payload)
    {
        $session = session();

        if ($payload['g-recaptcha-response'] != \getenv('globals.recaptcha.tokenTest') & !validateRecaptcha($payload['g-recaptcha-response']))
            throw new Exceptions(lang("Validation.recaptcha"), BAD_REQUEST);

        $hasAmountsNotNumbers = \array_filter($payload['amounts'], fn($amount) => !is_int($amount));
        if (count($hasAmountsNotNumbers) > 0)
            throw new Exceptions(lang("Validation.invalid.field"), BAD_REQUEST);
        $userAuthId = $session->get('userAuthId');

        $amount = isset($payload['amounts'][0]) ? $payload['amounts'][0] : 1;
        $clientsModel = new  ClientsBusiness();
        $clientId = $clientsModel->store($payload, $userAuthId);

        $chargesBusiness = new ChargesBusiness();
        $charge = $chargesBusiness->getAvailableCharge([
            "reference" => $payload['product']
        ], $amount);

        $productId = $chargesBusiness->saveProduct($charge, [
            "amount" => $amount,
            "client_id" => $clientId,
            "reference" => $payload['product']
        ]);

        return (object)[
            "success" => lang("Api.payments.success.post"),
            "product_id" => $productId
        ];
    }
}
