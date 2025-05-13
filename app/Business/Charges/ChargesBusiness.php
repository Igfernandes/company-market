<?php

namespace App\Business\Charges;

use App\Business\BaseBusiness;
use App\Database\Entities\Finances\ChargeEntity;
use App\Database\Entities\Integrations\IntegrationBankEntity;
use App\Database\Models\Finances\ChargesModel;
use App\Database\Models\Integrations\IntegrationBanksModel;
use App\Libraries\Exceptions\Exceptions;
use App\Services\MercadoPago\MercadoPago;
use MercadoPago\Item;
use MercadoPago\Preference;

class ChargesBusiness
{
    use BaseBusiness;
    private ChargesModel $chargesModel;

    public function __construct()
    {
        $this->chargesModel = new ChargesModel();
    }

    /**
     * 
     * @param ChargeEntity $chargeEntity
     */
    public function saveProduct(ChargeEntity $chargeEntity, array $options)
    {
        $integrationBankModel = new IntegrationBanksModel();
        /** @var IntegrationBankEntity */
        $foundBank = $integrationBankModel->where(["type" => "MERCADO_PAGO"])->first();

        if (empty($foundBank))
            throw new Exceptions(\str_replace("{field}", lang("Words.bank"),  lang("Validation.not_found")), BAD_BUSINESS_RULES);

        $title = $chargeEntity->getTitle();
        \MercadoPago\SDK::setAccessToken($foundBank->getDecryptPrivateToken());
        $priceFiltered = $chargeEntity->getPromotionalPrice() > 0 ? $chargeEntity->getPromotionalPrice() : $chargeEntity->getPrice();

        /** @var Item */
        $product = new Item();
        $product->__set("id", $chargeEntity->getId());
        $product->__set("title", $title);
        $product->__set("quantity", $options['amount'] ?? 1);
        $product->__set("unit_price", (float)$priceFiltered);

        $description = $chargeEntity->getDescription();
        if (!empty($description)) {
            $product->__set("description", $description);
        }

        $preference = new Preference();
        $preference->items = [$product];

        $preference->__set("metadata", [
            "client_id" => $options['client_id'],
            "reference" => $options['reference']
        ]);
        $preference->__set("back_urls", [
            "success" => base_url("checkout/success"),
            "failure" => base_url("checkout/failed"),
            "pending" => base_url("checkout/pendent")
        ]);

        $preference->__set("auto_return", "approved");

        // Salva a preferência
        if (!$preference->save()) {
            throw new Exceptions(\str_replace("{field}", lang("Words.bank"),  lang("Validation.not_found")), BAD_BUSINESS_RULES);
        }

        return $preference->id;
    }

    public function hasCharge($query): bool
    {
        $founds = $this->chargesModel->where($query)->find();

        return !empty($founds);
    }


    public function getAvailableCharge(?array $query = [], int $amountCurrent = 1): ChargeEntity|false
    {

        /** @var array{ChargeEntity} */
        $founds = $this->chargesModel->select("charges.*")->join("payments", "payments.charge_id = charges.id", "left")
            ->where($query)->findAll();

        if (!isset($founds[0])) return false;

        $charge = $founds[0];
        $amounts = $charge->getAmount() - $amountCurrent;

        $isNotExpiredCharge = empty($charge->getExpiredAt()) || strtotime($charge->getExpiredAt()) > strtotime(date("Y-m-d"));

        if (!$isNotExpiredCharge || count($founds) > $amounts)
            return false;

        return $founds[0];
    }
}
