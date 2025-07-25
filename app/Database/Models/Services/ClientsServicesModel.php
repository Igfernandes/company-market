<?php

namespace App\Database\Models\Services;

use App\Database\Entities\Clients\ClientEntity;
use App\Database\Entities\Services\ClientServiceEntity;
use App\Database\Entities\Services\ServiceEntity;
use App\Traits\ModelTrait;
use CodeIgniter\Model;

class ClientsServicesModel extends Model
{
    use ModelTrait;

    protected $DBGroup          = 'default';
    protected $table            = 'clients_services';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Services\ClientServiceEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['service_id', 'client_id', 'is_confirm'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';

    public function getClientsWithServices(array $clientQuery, array $serviceQuery = []): array
    {
        $clientQueryUpdated = $this->addPrefixInQuery($clientQuery, "clients");
        $serviceQueryUpdated = $this->addPrefixInQuery($serviceQuery, "services");

        $model = $this->Select(" clients.*, services.*,
        clients.name as client_name, clients.id as client_id, clients.created_at as client_created_at, 
        clients.updated_at as client_updated_at,
        services.name as service_name, services.id as service_id, services.created_at as service_created_at,
        services.updated_at as service_updated_at")
            ->join("clients", "clients.id = clients_services.client_id")
            ->join("services", "services.id = clients_services.service_id");

        if (\count($clientQueryUpdated) > 0)
            $model->where($clientQueryUpdated);

        $founds = $model->where($serviceQueryUpdated)->findAll();

        return array_map(function (ClientServiceEntity $clientServiceData) {
            $clientService = new ClientServiceEntity();
            $clientEntity = new ClientEntity();
            $ServiceEntity = new ServiceEntity();

            /** @var array */
            $attributes = $clientServiceData->attributes;

            $clientEntity->store($attributes);
            $clientEntity->setId($attributes['client_id']);
            $clientEntity->setName($attributes['client_name']);
            $clientEntity->setCreatedAt($attributes['client_created_at']);
            $clientEntity->setUpdatedAt($attributes['client_updated_at']);

            $ServiceEntity->store($attributes);
            $ServiceEntity->setId($attributes['service_id']);
            $ServiceEntity->setName($attributes['service_name']);
            $ServiceEntity->setCreatedAt($attributes['service_created_at']);
            $ServiceEntity->setUpdatedAt($attributes['service_updated_at']);

            $clientService->setClientId($attributes['client_id']);
            $clientService->setServiceId($attributes['service_id']);
            $clientService->setClient($clientEntity);
            $clientService->setService($ServiceEntity);

            return $clientService;
        }, $founds);
    }
}
