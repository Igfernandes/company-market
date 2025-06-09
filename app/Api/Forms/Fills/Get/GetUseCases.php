<?php

namespace App\Api\Forms\Fills\Get;

use App\Database\Entities\CustomForms\FormFillEntity;
use App\Database\Models\CustomForms\FormFillsModel;
use App\Libraries\Crypto\Crypto;
use App\Traits\BusinessTrait;

class GetUseCases
{
    use BusinessTrait;

    /**
     * @param array{ 
     *     form_id: int,
     * } $payload
     */
    public function execute(array $payload)
    {
        $filteredPayload = \array_filter($payload, fn($field) => !empty($field));

        $formFillsModel = new FormFillsModel();
        $crypto = new Crypto();

        /** @var Array{FormFillEntity} */
        $foundFields = $formFillsModel->where($filteredPayload)->findAll();

        if (isset($filteredPayload['package']))
            return array_map(function (FormFillEntity $field) use ($crypto) {
                $data = $field->toArray();
                $data['ref'] = $field->getPackage();
                unset($data['package']);

                $data['value'] = $crypto->decrypt($field->getValue(), $data['ref'] . getenv('system.encrypted_key'));
                return $data;
            }, $foundFields);


        $registers = [];
        foreach ($foundFields as $field) {
            if (!isset($registers[$field->getPackage()]))
                $registers[$field->getPackage()] = [];

            $data = $field->toArray();
            $data['ref'] = $field->getPackage();
            unset($data['package']);

            $data['value'] = $crypto->decrypt($field->getValue(), $data['ref'] . getenv('system.encrypted_key'));

            \array_push($registers[$field->getPackage()], $data);
        }

        return \array_values($registers);
    }
}
