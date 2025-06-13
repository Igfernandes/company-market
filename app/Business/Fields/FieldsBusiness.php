<?php


namespace App\Business\Fields;

use App\Business\BaseBusiness;
use App\Database\Models\Fields\ClientsFieldsModel;
use App\Database\Models\Fields\FieldsGroupsModel;
use App\Database\Models\Fields\FieldsModel;
use App\Database\Models\Fields\UsersFieldsModel;
use App\Libraries\Exceptions\Exceptions;

class FieldsBusiness
{
    use BaseBusiness;

    public function hasGroup($groupId): bool
    {
        $fieldsGroups = new FieldsGroupsModel();
        $foundFieldsGroups = $fieldsGroups->where(["id" => $groupId])->find();

        return !empty($foundFieldsGroups);
    }

    /**
     * @param array{
     *  field_id: integer,
     *  entity_id: integer,
     *  value: string,
     *  value_encrypted: string,
     *  scope: "USER"|"CLIENT"|"COMPANY"
     * } $data
     */

    public function storeFieldValue(array $payload)
    {
        $model = [
            "USER" => new UsersFieldsModel(),
            "CLIENT" => new ClientsFieldsModel()
        ];
        $keyEntity = \strtolower($payload['scope']) . "_id";

        if (!isset($model[$payload["scope"]]))
            throw new Exceptions("Fields Case: Api.fields.invalid.operation_invalid");

        $data = [
            "field_id"  => $payload["field_id"],
            $keyEntity  => $payload['entity_id'],
        ];

        if (!isset($payload['value_encrypted']) || empty($payload['value_encrypted']))
            $valueData =  [
                "column" => "value",
                "value" => \json_encode((object)[
                    "data" => $payload['value']
                ])
            ];
        else $valueData = [
            "column" => "value_encrypted",
            "value" => $payload['value_encrypted']
        ];

        $foundField = $model[$payload["scope"]]->where($data)->first();

        if (!empty($foundField)) {
            $model[$payload["scope"]]->set($valueData['column'], $valueData['value'])->where($data)->update();
            return;
        }

        $data[$valueData['column']] = $valueData['value'];
        $model[$payload["scope"]]->save($data);
    }

    public function hasField(array $fieldsId = [])
    {
        $fieldModel = new FieldsModel();

        $foundFields = $fieldModel->whereIn("id", $fieldsId)->findAll();

        return count($foundFields) == \count($fieldsId);
    }
}
