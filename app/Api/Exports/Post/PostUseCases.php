<?php

namespace App\Api\Exports\Post;

use App\Business\Exports\ExportsBusiness;
use App\Business\Exports\ExportsClientsBusiness;
use App\Business\Exports\ExportsFormsBusiness;
use App\Libraries\Exceptions\Exceptions;

class PostUseCases
{
    private array $instances = [
        "CLIENTS" => ExportsClientsBusiness::class,
        "FORMS" =>  ExportsFormsBusiness::class
    ];
    private int $maxIds = 500;

    /**
     * @param array{
     *  in_ids: array{integer},
     *  entity: string,
     *  type: "EXCEL"|"PDF"
     * } $payload
     */
    public function execute(array $payload)
    {
        if (!isset($this->instances[$payload['entity']]))
            throw new Exceptions("Api.exports.invalid.entity", \BAD_AUTH);

        $entityInstance = $this->instances[$payload['entity']];

        if (empty($entityInstance) || !$entityInstance)
            throw new Exceptions("Api.exports.invalid.entity", \BAD_AUTH);
        if (count($payload['in_ids']) > $this->maxIds)
            throw new Exceptions("Api.exports.invalid.entity", \BAD_AUTH);

        $exportData = new $entityInstance();

        switch ($payload['type']):
            case "PDF":
                $data = $exportData->getData($payload['in_ids'] ?? []);
                $file = ExportsBusiness::pdf(strtolower($payload['entity']), $data);
                break;
            case "EXCEL":
                $data = $exportData->getData($payload['in_ids'] ?? []);
                $file = ExportsBusiness::excel(strtolower($payload['entity']), $data);
        endswitch;

        return (object)[
            "success" => "Api.exports.success.post",
            "file" => $file
        ];
    }
}
