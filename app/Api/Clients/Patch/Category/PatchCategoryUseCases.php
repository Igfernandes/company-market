<?php

namespace App\Api\Clients\Patch\Category;

use App\Database\Models\Clients\CategoriesModel;
use App\Database\Models\Clients\ClientsCategoriesModel;
use App\Interfaces\IUseCases;
use App\Libraries\Exceptions\Exceptions;

class PatchCategoryUseCases implements IUseCases
{
    /**
     * @param array{
     *   category: number,
     *   clients: array{integer}
     * } $payload
     */
    public function execute(array $payload): object
    {
        $session = session();

        if (!isset($payload['clients']) || count($payload['clients']) == 0)
            throw new Exceptions(lang('Api.clients.invalid.required_clients'), BAD_BUSINESS_RULES);

        $clientsCategoriesModel = new ClientsCategoriesModel();
        $categoryModel = new CategoriesModel();

        $foundCategory = $categoryModel->where("id", $payload['category'])->first();

        if (empty($foundCategory))
            throw new Exceptions(lang('Api.clients.invalid.category'), BAD_BUSINESS_RULES);

        $clientsCategoriesModel->set("category_id", $payload['category'])->whereIn('client_id', $payload['clients'])->update();

        return (object)[
            "success" => \str_replace("{name}", $foundCategory->getName(), lang("Api.clients.success.patchCategory"))
        ];
    }
}
