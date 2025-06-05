<?php

namespace App\Services\MercadoPago\Operations;

use App\Database\Entities\Reports\OperationFailureEntity;
use App\Libraries\Cerberus\Cerberus;
use App\Services\MercadoPago\DTOs\UserDTO;
use App\Services\MercadoPago\ReportsUserConstants;
use MercadoPago\Preference;
use MercadoPago\SDK;

trait WebHooks
{
    private string $accessToken;

    public function storeWebHook(UserDTO $user): bool
    {
        SDK::setAccessToken($this->accessToken);

        if (!$user->id) {
            $operationFailure = new OperationFailureEntity();
            $data = ReportsUserConstants::$NOT_FOUND_USER;

            $data['payload_sent'] = \json_encode((object)[
                "field" => "accessToken"
            ]);
            $operationFailure->store($data);

            Cerberus::report($operationFailure);
        }
        
        $preference = new Preference();
        $preference->items = [/* seus itens */];
        $preference->notification_url = getenv('system.gateway.webhook.payment');
        // outros campos...

        $preference->save();
        return true;
    }
}
