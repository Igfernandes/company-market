<?php

namespace App\Services\MercadoPago\Operations;

use App\Database\Entities\Finances\ChargeEntity;
use App\Libraries\Exceptions\Exceptions;
use MercadoPago\Item;
use MercadoPago\Preference;


trait ProductPunctual
{
    /**
     * @param ChargeEntity $charge
     * @param array{
     *      title: string,
     *      amount: integer,
     *      price: integer,
     *      client_id: integer,
     *      reference: string
     * } $options
     */
    function createPunctual(ChargeEntity $charge, array $options)
    {
        /** @var Item */
        $product = new Item();
        $product->__set("id", $charge->getId());
        $product->__set("title", $options['title']);
        $product->__set("quantity", $options['amount'] ?? 1);
        $product->__set("unit_price", (float)$options['price']);

        $description = $charge->getDescription();
        if (!empty($description)) {
            $product->__set("description", $description);
        }

        $preference = new Preference();
        $preference->items = [$product];

        $preference->__set("metadata", [
            "client_id" => $options['client_id'],
            "reference" => $options['reference']
        ]);
        $isLocalhost = \ENVIRONMENT === "development";
        $baseLocalhost = getenv('globals.href.backend');

        $preference->__set("back_urls", [
            "success" => $isLocalhost ? "$baseLocalhost/checkout/success" : base_url("checkout/success"),
            "failure" => $isLocalhost ? "$baseLocalhost/checkout/failed" : base_url("checkout/failed"),
            "pending" => $isLocalhost ? "$baseLocalhost/checkout/pendent" : base_url("checkout/pendent")
        ]);

        $preference->__set("auto_return", "approved");

        // Salva a preferência
        if (!$preference->save()) {
            throw new Exceptions(\str_replace("{field}", lang("Words.bank"),  lang("Validation.not_found")), BAD_BUSINESS_RULES);
        }

        return $preference->id;
    }
}
