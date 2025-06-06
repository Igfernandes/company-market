<?php

namespace App\Database\Models\Fields;

use App\Database\Entities\Clients\ClientEntity;
use App\Database\Entities\Fields\ClientFieldEntity;
use App\Database\Entities\Fields\FieldEntity;
use App\Traits\ModelTrait;
use CodeIgniter\Model;

class ClientsFieldsModel extends Model
{

    use ModelTrait;

    protected $DBGroup          = 'default';
    protected $table            = 'clients_fields';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Fields\ClientFieldEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['field_id', 'client_id', 'value', 'value_encrypted'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';

    public function getClientsWithFields(array $clientQuery, array $fieldsQuery = []): array
    {
        $clientQueryUpdated = $this->addPrefixInQuery($clientQuery, "clients");
        $fieldQueryUpdated = $this->addPrefixInQuery($fieldsQuery, "fields");

        $founds = $this->Select(" clients.*, fields.*, clients_fields.value, clients_fields.value_encrypted,
        clients.name as client_name, clients.id as client_id, clients.created_at as client_created_at, 
        clients.updated_at as client_updated_at,
        fields.name as field_name, fields.id as field_id, fields.created_at as field_created_at,
        fields.updated_at as field_updated_at")
            ->join("clients", "clients.id = clients_fields.client_id")
            ->join("fields", "fields.id = clients_fields.field_id")
            ->where($clientQueryUpdated)
            ->where($fieldQueryUpdated)->findAll();

        return array_map(function (ClientFieldEntity $clientFieldData) {
            $clientFieldEntity = new ClientFieldEntity();
            $clientEntity = new ClientEntity();
            $fieldEntity = new FieldEntity();

            /** @var array */
            $attributes = $clientFieldData->attributes;

            $clientEntity->store($attributes);
            $clientEntity->setId($attributes['client_id']);
            $clientEntity->setName($attributes['client_name']);
            $clientEntity->setCreatedAt($attributes['client_created_at']);
            $clientEntity->setUpdatedAt($attributes['client_updated_at']);

            $fieldEntity->store($attributes);
            $fieldEntity->setId($attributes['field_id']);
            $fieldEntity->setName($attributes['field_name']);
            $fieldEntity->setCreatedAt($attributes['field_created_at']);
            $fieldEntity->setUpdatedAt($attributes['field_updated_at']);

            $clientFieldEntity->setClientId($attributes['client_id']);
            $clientFieldEntity->setFieldId($attributes['field_id']);
            $clientFieldEntity->setValue($attributes['value']);
            $clientFieldEntity->setValueEncrypted($attributes['value_encrypted']);
            $clientFieldEntity->setClient($clientEntity);
            $clientFieldEntity->setField($fieldEntity);

            return $clientFieldEntity;
        }, $founds);
    }
}
