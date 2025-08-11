<?php

namespace App\Api\Operations\Forms\Fills\Get;

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
        helper("files");
        $filteredPayload = \array_filter($payload, fn($query) => !empty($query));

        $formFillsModel = new FormFillsModel();
        $crypto = new Crypto();

        /** @var Array{FormFillEntity} */
        $foundFields = $formFillsModel->orderBy('created_at', "DESC")->where($filteredPayload)->findAll();

        if (isset($filteredPayload['package']))
            return array_map(function (FormFillEntity $field) use ($crypto) {
                $data = $field->toArray();
                $data['ref'] = $field->getPackage();
                unset($data['package']);

                $data['value'] = $crypto->decrypt($field->getValue(), $data['ref'] . getenv('system.encrypted_key'));

                $data = $this->fixProblemWithOldRulesInFiles($data);

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
            $data = $this->fixProblemWithOldRulesInFiles($data);

            \array_push($registers[$field->getPackage()], $data);
        }

        return \array_values($registers);
    }

    public function fixProblemWithOldRulesInFiles(array $data)
    {
        if (strstr($data['value'], "[") !== false && strstr($data['value'], 'writable') !== false) {
            $files = \json_decode($data['value']);
            $filesWithPubliCUrl = \array_map(fn(string $file) => \getPublicUrl($file), $files);

            $data['value'] = \json_encode($filesWithPubliCUrl);
        }
        if (strstr($data['value'], 'writable') !== false) {
            $data['value'] = \getPublicUrl($data['value']);
        }

        return $data;
    }
}
