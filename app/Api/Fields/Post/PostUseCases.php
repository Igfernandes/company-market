<?php

namespace App\Api\Fields\Post;

use App\Business\Fields\FieldsBusiness;
use App\Database\Entities\Fields\FieldEntity;
use App\Database\Models\Fields\FieldsGroupsModel;
use App\Database\Models\Fields\FieldsModel;
use App\Libraries\Exceptions\Exceptions;
use Exception;

class PostUseCases
{
    /**
     * @param array{
     *  name: string,
     *  component: "INPUT"|"SELECT"|"TEXTAREA",
     *  type: string|null,
     *  scope: "USER"|"CLIENT"|"COMPANY",
     *  is_required: boolean,
     *  is_sensitive: boolean,
     *  group_id: integer,
     *  value: string|null,
     *  relation_id: number|null
     * } $payload
     */
    public function execute(array $payload)
    {

        $fieldsModel = new FieldsModel();
        $fieldsEntity = new FieldEntity();
        $fieldBusiness = new FieldsBusiness();

        if (!$fieldBusiness->hasGroup($payload['group_id']))
            throw new Exceptions(lang("Api.fields.invalid.group"), BAD_BUSINESS_RULES);

        if ($payload["type"] === "FILE") {
            $fieldsGroupsModel = new FieldsGroupsModel();

            $foundGroup = $fieldsGroupsModel->where("name", "ATTACHMENTS")->first();
            $payload['group_id'] = $foundGroup->getId();
        }


        $fieldsEntity->store($payload);

        $fieldsModel->save($fieldsEntity);

        if (isset($payload["relation_id"]) && isset($payload['value']))
            $fieldBusiness->storeFieldValue([
                "entity_id" => $payload["relation_id"],
                "field_id" => $fieldsModel->getInsertID(),
                "value" => $payload['value'],
                "scope" => $payload['scope']
            ]);

        return (object)[
            "success" => lang("Api.fields.success.post")
        ];
    }
}
