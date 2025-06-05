<?php

namespace App\Services\MercadoPago\Operations;

use App\Database\Entities\Clients\ClientEntity;
use App\Database\Entities\Finances\ChargeEntity;
use App\Database\Models\Clients\ClientsModel;
use App\Libraries\Exceptions\Exceptions;
use MercadoPago\Item;
use MercadoPago\Preapproval;
use MercadoPago\Preference;


trait ProductAppellant
{
    /**
     * @param ChargeEntity $charge
     * @param array{
     *      title: string,
     *      price: integer,
     *      client_id: string,
     * } $options
     */
    function createAppellant(ChargeEntity $charge, array $options)
    {
        /** @var Item */
        $preapproval = new Preapproval();

        $preapproval->reason = $options['title'];
        $preapproval->auto_recurring = [
            "frequency" => 12,
            "frequency_type" => "months",
            "transaction_amount" => $options['price'],
            "currency_id" => "BRL",
            "start_date" => date('c'),
            "end_date" => date('c', strtotime($charge->getExpiredAt() ?: '+1 year'))
        ];

        $clientModel = new ClientsModel();

        /** @var ClientEntity */
        $foundClient = $clientModel->where("id", $options['client_id'])->first();

        // Salva a preferência
        if (empty($foundClient))
            throw new Exceptions(lang("Validation.user_invalid"), BAD_BUSINESS_RULES);


        $preapproval->back_url = base_url("checkout/success");
        $preapproval->payer_email = $foundClient->getDecryptEmail();


    
        // Salva a preferência
        if (!$preapproval->save())
            throw new Exceptions(\str_replace("{field}", lang("Words.bank"),  lang("Validation.not_found")), BAD_BUSINESS_RULES);


        return $preapproval->init_point;
    }
}
