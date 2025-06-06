<?php


namespace App\Api\WebHooks\WhatsApp\Get;

use App\Libraries\Exceptions\Exceptions;
use App\Traits\BusinessTrait;

class GetUseCases
{
    use BusinessTrait;

    /**
     * Processa o payload recebido do webhook do Facebook/Instagram Messenger.
     *
     * @param array{
     *    hub_verify_token: string,
     *    hub_challenge: string
     *   }>
     * } $payload
     */
    public function execute(array $payload)
    {

        if (!isset($payload['hub_verify_token']))
            throw new Exceptions(lang("Errors.not_found"), \NOT_FOUND);

        if ($payload['hub_verify_token'] !== \getenv('private.meta.verify_token'))
            throw new Exceptions(lang("Errors.not_found"), \NOT_FOUND);

        return  $payload['hub_challenge'];
    }
}
