<?php

namespace App\Api\Notifications\Subscribes\Post;

use App\Database\Entities\Subscribes\SubscribeEntity;
use App\Database\Models\Subscribes\SubscribesModel;
use App\Traits\BusinessTrait;
use App\Traits\Services\ServicesDataTrait;

use function PHPUnit\Framework\isJson;

class PostUseCases
{
    use ServicesDataTrait, BusinessTrait;

    /**
     * @param array{
     *     phone: string,
     *     type: string,
     *     data: string 
     * } $payload
     */
    public function execute(array $payload)
    {
        $filteredPayload = \array_filter($payload, fn($field) => !empty($field));

        $subscribesModels = new SubscribesModel();
        $subscribeEntity  = new SubscribeEntity();

        $phone = str_replace(['+', '-', ' ', '(', ')'], '', $filteredPayload['phone']);
        $subscribeEntity->setPhoneSha256(\referenceHash($phone));
        $subscribeEntity->setType($filteredPayload['type']);
        $subscribeEntity->setData(isJson($filteredPayload['data']) ? $filteredPayload['data'] : \json_decode($filteredPayload['data']));

        $subscribesModels->upsert([
            "phone_sha256" => $subscribeEntity->getPhoneSha256()
        ], $subscribeEntity);

        return (object)[
            "success" => "Api.subscribe.success.post"
        ];
    }
}
