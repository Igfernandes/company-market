<?php

namespace App\Services\MercadoPago;

use App\Services\MercadoPago\Operations\Authentication;
use App\Services\MercadoPago\Operations\WebHooks;
use MercadoPago\SDK;
use MercadoPago\Preference;
use MercadoPago\Item;
use MercadoPago\Payment;

class MercadoPago
{
    use WebHooks;

    private string $accessToken;
    private Authentication $authentication;

    public function __construct(string $accessToken)
    {
        $this->accessToken = $accessToken;
        $this->authentication = new Authentication($accessToken);
    }

    public function init()
    {
        // $user = $this->authentication->getUser();
        // $this->storeWebHook($user);
    }

    /**
     * @method createProduct 
     * 
     * @param string $privateToken 
     * @param array{Item} $products
     */
    public function createProduct(array $products): Preference
    {
        SDK::setAccessToken($this->accessToken);

        $preference = new Preference();
        $preference->items = $products;
        $preference->save();

        return $preference;
    }

    /**
     * @method getPayment 
     * 
     * @param string $privateToken 
     * @param array{Item} $paymentId
     */
    public function getPayment(int $paymentId): Payment
    {
        SDK::setAccessToken($this->accessToken);

        $payment = Payment::find_by_id($paymentId);

        return $payment;
    }
}
