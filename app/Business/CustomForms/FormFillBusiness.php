<?php

namespace App\Business\CustomForms;

use App\Business\Clients\ClientsBusiness;
use App\Business\Fields\FieldsComponentsBusiness;
use App\Database\Entities\CustomForms\ClientFormHistoryEntity;
use App\Database\Entities\CustomForms\FormFillEntity;
use App\Database\Models\CustomForms\ClientsFormsHistoryModel;
use App\Libraries\Crypto\Crypto;
use DateTime;

class FormFillBusiness
{
    public static function store(array $field, array $components)
    {
        $value = $field['value'];
        $id = \str_replace("input_", "", $field['name']);
        $crypto = new Crypto();
        $formFillEntity = new FormFillEntity();

        $currentField = FormFillBusiness::getComponent($id, $components);
        if (!isset($currentField->element))
            return null;

        if (\array_search($currentField->element, ['birthdate', 'date'])) {
            $dateObject = DateTime::createFromFormat('d/m/Y', $value);
            $value = $dateObject ? $dateObject->format('Y-m-d') : $value;
        }

        $formFillEntity->setFieldId($id);
        $formFillEntity->setPackage($field['package']);
        $formFillEntity->setFormId($field['form_id']);

        if ($currentField->element == "file") {
            $value = FieldsComponentsBusiness::file($value);
        } elseif ($currentField->element === "gallery") {
            $value = FieldsComponentsBusiness::gallery($value);
        }

        $valueEncrypted = $crypto->encrypt($value, $field['package'] . getenv('system.encrypted_key'));
        $formFillEntity->setValue($valueEncrypted);

        return $formFillEntity;
    }

    public static function getComponent(string $id, array $components)
    {
        /** @var array{FieldEntity} */
        $possibleFields = \array_values(array_filter($components, fn($field) => $field->id === $id));

        if (\count($possibleFields) == 0)
            return null;

        return $possibleFields[0];
    }

    public static function isComponent(array $components, int $fieldId, string $componentName)
    {
        $foundComponents = array_filter(
            $components,
            fn($field) => $field->id == $fieldId && $field->element == $componentName
        );

        return \count($foundComponents) > 0;
    }

    public static function clientCreate(array $clientData, int $formId, string $package)
    {
        $clientBusiness = new ClientsBusiness();
        $clientId = $clientBusiness->store($clientData);

        $clientsFormsHistory = new ClientsFormsHistoryModel();
        $clientFormHistoryEntity = new ClientFormHistoryEntity();

        $clientFormHistoryEntity->setClientId($clientId);
        $clientFormHistoryEntity->setFormId($formId);
        $clientFormHistoryEntity->setPackage($package);

        $clientsFormsHistory->save($clientFormHistoryEntity);
    }
}
