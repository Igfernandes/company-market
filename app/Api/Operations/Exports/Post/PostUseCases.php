<?php

namespace App\Api\Operations\Exports\Post;

use App\Business\Exports\ExportsBusiness;
use App\Business\Exports\ExportsClientsBusiness;
use App\Business\Exports\ExportsFormFillsBusiness;
use App\Business\Exports\ExportsFormsBusiness;
use App\Business\Users\ExportsUsersBusiness;
use App\Libraries\Exceptions\Exceptions;
use CodeIgniter\HTTP\ResponseInterface;

class PostUseCases
{
    private array $instances = [
        "USERS" => ExportsUsersBusiness::class,
        "CLIENTS" => ExportsClientsBusiness::class,
        "FORMS" =>  ExportsFormsBusiness::class,
        "FORMS_FILLS" => ExportsFormFillsBusiness::class
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
        $instanceIndex = \strtoupper($payload['entity']);

        if (!isset($this->instances[$instanceIndex]))
            throw new Exceptions("Api.exports.invalid.entity", ResponseInterface::HTTP_NOT_ACCEPTABLE);

        $entityInstance = $this->instances[$instanceIndex];

        if (empty($entityInstance) || !$entityInstance)
            throw new Exceptions("Api.exports.invalid.entity", ResponseInterface::HTTP_NOT_ACCEPTABLE);
        if (count($payload['in_ids']) > $this->maxIds)
            throw new Exceptions("Api.exports.invalid.entity", ResponseInterface::HTTP_NOT_ACCEPTABLE);

        $exportData = new $entityInstance();

        switch ($payload['type']):
            case "PDF":
                $data = $exportData->getData($payload['in_ids'] ?? []);
                $file = ExportsBusiness::pdf(strtolower($instanceIndex), $data);
                break;
            case "EXCEL":
                $data = $exportData->getData($payload['in_ids'] ?? []);
                $file = ExportsBusiness::excel(strtolower($instanceIndex), $data);
        endswitch;

        return (object)[
            "success" => "Api.exports.success.post",
            "file" => $file
        ];
    }
}
