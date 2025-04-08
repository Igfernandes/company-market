<?php


namespace App\Business\Fields;

use App\Business\BaseBusiness;
use App\Database\Models\Fields\ClientsFieldsModel;
use App\Database\Models\Fields\FieldsGroupsModel;
use App\Database\Models\Fields\FieldsModel;
use App\Database\Models\Fields\UsersFieldsModel;
use App\Libraries\Exceptions\Exceptions;
use CodeIgniter\HTTP\Files\UploadedFile;

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
            throw new Exceptions("Fields Case:" . lang("Errors.operation_invalid"));

        $data = [
            "field_id"  => $payload["field_id"],
            $keyEntity  => $payload['entity_id'],
        ];
        $jsonValue = \json_encode((object)[
            "data" => $payload['value']
        ]);

        $foundField = $model[$payload["scope"]]->where($data)->first();

        if (!empty($foundField)) {
            $model[$payload["scope"]]->set("value", $jsonValue)->where($data)->update();
            return;
        }

        $data['value'] = $jsonValue;
        $model[$payload["scope"]]->save($data);
    }

    public function hasField(array $fieldsId = [])
    {
        $fieldModel = new FieldsModel();

        $foundFields = $fieldModel->whereIn("id", $fieldsId)->findAll();

        return count($foundFields) == \count($fieldsId);
    }

    public function upload(UploadedFile $file): string
    {
        \var_dump($file);
        if (!$file->isValid())
            throw new Exceptions(lang("Api.files.invalid.file"), \BAD_BUSINESS_RULES);

        $extension = $file->getExtension();
        $fileName = date("Y_m_d-H_i_s") . "_field.$extension";

        $file->move(WRITEPATH . 'uploads', $fileName);

        return WRITEPATH . "uploads/$fileName";
    }
}
