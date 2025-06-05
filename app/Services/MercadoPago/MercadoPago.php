<?php

namespace App\Services\MercadoPago;

use App\Database\Entities\Finances\ChargeEntity;
use App\Database\Models\Integrations\IntegrationBanksModel;
use App\Libraries\Exceptions\Exceptions;
use App\Services\MercadoPago\Operations\Authentication;
use App\Services\MercadoPago\Operations\ProductAppellant;
use App\Services\MercadoPago\Operations\ProductPunctual;
use App\Services\MercadoPago\Operations\WebHooks;
use MercadoPago\SDK;
use MercadoPago\Item;
use MercadoPago\Payment;

class MercadoPago
{
    use WebHooks, ProductPunctual, ProductAppellant;

    private string $accessToken;
    private Authentication $authentication;

    public function __construct()
    {
        $this->accessToken = $this->getInstance();
    }

    function getInstance(): string
    {
        $integrationBankModel = new IntegrationBanksModel();
        /** @var IntegrationBankEntity */
        $foundBank = $integrationBankModel->where(["type" => "MERCADO_PAGO"])->first();

        if (empty($foundBank))
            throw new Exceptions(\str_replace("{field}", lang("Words.bank"),  lang("Validation.not_found")), BAD_BUSINESS_RULES);

        return $foundBank->getDecryptPrivateToken();
    }

    /**
     * @method createCharge 
     * 
     * @param ChargeEntity $chargeEntity 
     * @param array $options
     */
    public function storeCharge(ChargeEntity $chargeEntity, array $options): array
    {

        $title = $chargeEntity->getTitle();
        \MercadoPago\SDK::setAccessToken($this->accessToken);
        $priceFiltered = $chargeEntity->getPromotionalPrice() > 0 ? $chargeEntity->getPromotionalPrice() : $chargeEntity->getPrice();

        $options['title'] = $title;
        $options['price'] = $priceFiltered;

        $response = [];

        if ($chargeEntity->getType() === "PUNCTUAL")
            $response['product_id'] =  $this->createPunctual($chargeEntity, $options);
        else
            $response['product_url'] = $this->createAppellant($chargeEntity, $options);

        return $response;
    }

    /**
     * @method getPayment 
     * 
     * @param string $privateToken 
     * @param array{Item} $paymentId
     */
    public function getPayment(int $paymentId): Payment|null
    {
        SDK::setAccessToken($this->accessToken);

        $payment = Payment::find_by_id($paymentId);

        return $payment;
    }
}
