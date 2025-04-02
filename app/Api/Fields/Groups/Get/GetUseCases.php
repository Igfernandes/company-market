<?php

namespace App\Api\Fields\Groups\Get;

use App\Database\Entities\Fields\FieldsGroupEntity;
use App\Database\Models\Fields\FieldsGroupsModel;
use App\Libraries\Exceptions\Exceptions;
use App\Traits\BusinessTrait;
use App\Traits\Fields\FieldsGroupsDataTrait;

class GetUseCases
{
    use FieldsGroupsDataTrait, BusinessTrait;

    /**
     * @param array{
     *     id: int,
     *     in_ids: array<int>, 
     *     name: string, 
     *     name_contains: string,
     *     scope: string,
     * } $payload
     */
    public function execute(array $payload)
    {
        $filteredPayload = \array_filter($payload, fn($field) => !empty($field));

        $fieldsGroupsModel = new FieldsGroupsModel();
        $fieldsGroupsEntity = new FieldsGroupEntity();

        $in_ids = isset($filteredPayload['in_ids']) ? $filteredPayload['in_ids'] : [];

        $fieldsGroupsModel = $this->builderClauseWithContains($filteredPayload ?? [], $fieldsGroupsModel);

        if (isset($filteredPayload['field_id'])) {
            $fieldsGroupsModel->select("fields.id as field_id, fields_groups.*")->join("fields", "fields.group_id =  fields_groups.id")->where("fields.id", $filteredPayload['field_id']);
        }
        if (isset($filteredPayload['id'])) {
            $fieldsGroupsModel->where("fields_groups.id", $filteredPayload['id']);
            unset($filteredPayload['id']);
        }

        if (isset($filteredPayload['scope'])) {
            $fieldsGroupsModel->like("scope", $filteredPayload['scope']);
            unset($filteredPayload['scope']);
        }

        if (count($in_ids) > 0)
            $fieldsGroupsModel->whereIn("id", $in_ids);

        $fieldsGroupsEntity->store($filteredPayload);
        $fieldsGroups = $fieldsGroupsModel->where($fieldsGroupsEntity->toArray())->findAll();

        if (!empty($payload['id']) && count($fieldsGroups) > 0)
            return $this->builder($fieldsGroups[0]);
        else if (!empty($payload['id']) && \count($fieldsGroups) == 0)
            throw new Exceptions(lang("Errors.not_found"), \NOT_FOUND);

        $servicesData = array_map(
            fn(FieldsGroupEntity $fieldsGroup) => $this->builder($fieldsGroup),
            $fieldsGroups
        );

        return \array_values($servicesData);
    }
}
