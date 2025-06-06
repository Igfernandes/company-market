<?php

namespace App\Database\Models\Finances;

use App\Database\Entities\Clients\ClientEntity;
use App\Database\Entities\Finances\ChargeClientEntity;
use App\Database\Entities\Finances\ChargeEntity;
use App\Traits\ModelTrait;
use CodeIgniter\Model;

class ChargesClientsModel extends Model
{

    use ModelTrait;

    protected $DBGroup          = 'default';
    protected $table            = 'charges_clients';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Finances\ChargeClientEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['charge_id', 'client_id', 'value'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';

    public function getClientsWithCharges(array $clientQuery, array $chargesQuery = []): array
    {
        $clientQueryUpdated = $this->addPrefixInQuery($clientQuery, "clients");
        $chargesQueryUpdated = $this->addPrefixInQuery($chargesQuery, "charges");

        $founds = $this->Select(" clients.*, charges.*, clients_charges.value,
        clients.name as client_name, clients.id as client_id, clients.created_at as client_created_at, 
        clients.updated_at as client_updated_at,
        charges.id as charge_id, charges.created_at as charge_created_at, charges.updated_at as charge_updated_at")
            ->join("clients", "clients.id = clients_charges.client_id")
            ->join("charges", "charges.id = clients_charges.charge_id")
            ->where($clientQueryUpdated)
            ->where($chargesQueryUpdated)->findAll();

        return array_map(function (ChargeClientEntity $chargeClientData) {
            $chargeClientEntity = new ChargeClientEntity();
            $clientEntity = new ClientEntity();
            $chargeEntity = new ChargeEntity();

            /** @var array */
            $attributes = $chargeClientData->attributes;

            $clientEntity->store($attributes);
            $clientEntity->setId($attributes['client_id']);
            $clientEntity->setName($attributes['client_name']);
            $clientEntity->setCreatedAt($attributes['client_created_at']);
            $clientEntity->setUpdatedAt($attributes['client_updated_at']);

            $chargeEntity->store($attributes);
            $chargeEntity->setId($attributes['charge_id']);
            $chargeEntity->setCreatedAt($attributes['charge_created_at']);
            $chargeEntity->setUpdatedAt($attributes['charge_updated_at']);

            $chargeClientEntity->setClientId($attributes['client_id']);
            $chargeClientEntity->setChargedId($attributes['charge_id']);
            $chargeClientEntity->setClient($clientEntity);
            $chargeClientEntity->setCharge($chargeEntity);

            return $chargeClientEntity;
        }, $founds);
    }
}
