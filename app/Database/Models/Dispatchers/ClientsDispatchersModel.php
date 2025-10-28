<?php

namespace App\Database\Models\MessagesDispatcher;

use App\Database\Entities\Clients\ClientEntity;
use App\Database\Entities\Dispatchers\ClientDispatcherEntity;
use App\Database\Entities\Dispatchers\DispatcherEntity;
use App\Traits\ModelTrait;
use CodeIgniter\Model;

class ClientsDispatchersModel extends Model
{

    use ModelTrait;

    protected $table            = 'clients_dispatchers';
    protected $primaryKey       = 'id';
    protected $useSoftDeletes   = false;
    protected $returnType       = 'App\Database\Entities\Dispatchers\ClientDispatcherEntity';

    protected $allowedFields = [
        'client_id',
        'dispatcher_id',
        'status',
        'platform',
        'log_error',
        'send_at',
        'created_at',
    ];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';


    public function getClientsWithMessages(array $clientQuery, array $dispatcherQuery = [], array $clientsDispatchersQuery = []): array
    {
        $clientQueryUpdated = $this->addPrefixInQuery($clientQuery, "clients");
        $messageDispatcherQueryUpdated = $this->addPrefixInQuery($dispatcherQuery, "dispatchers");
        $clientsMessageDispatcherQueryUpdated = $this->addPrefixInQuery($clientsDispatchersQuery, "clients_dispatchers");

        $founds = $this->select(" clients.*, dispatchers.*, clients_dispatchers.*,
        clients.name as client_name, clients.id as client_id, clients.created_at as client_created_at, 
        clients.updated_at as client_updated_at,
        dispatchers.id as dispatcher_id, dispatchers.created_at as dispatcher_created_at,
        dispatchers.updated_at as dispatcher_updated_at")
            ->join("clients", "clients.id = clients_dispatchers.client_id")
            ->join("dispatchers", "dispatchers.id = clients_dispatchers.dispatcher_id")
            ->where($clientQueryUpdated)
            ->where($messageDispatcherQueryUpdated)
            ->where($clientsMessageDispatcherQueryUpdated)->findAll();

        return array_map(function (ClientDispatcherEntity $clientDispatcherData) {
            $clientDispatcher = new ClientDispatcherEntity();
            $clientEntity = new ClientEntity();
            $dispatcherEntity = new DispatcherEntity();

            /** @var array */
            $attributes = $clientDispatcherData->attributes;

            $clientEntity->store($attributes);
            $clientEntity->setId($attributes['client_id']);
            $clientEntity->setName($attributes['client_name']);
            $clientEntity->setCreatedAt($attributes['client_created_at']);
            $clientEntity->setUpdatedAt($attributes['client_updated_at']);

            $dispatcherEntity->store($attributes);
            $dispatcherEntity->setId($attributes['dispatcher_id']);
            $dispatcherEntity->setCreatedAt($attributes['dispatcher_created_at']);
            $dispatcherEntity->setUpdatedAt($attributes['dispatcher_updated_at']);

            $clientDispatcher->store($attributes);
            $clientDispatcher->setClientId($attributes['client_id']);
            $clientDispatcher->setDispatcherId($attributes['dispatcher_id']);
            $clientDispatcher->setClient($clientEntity);
            $clientDispatcher->setDispatcher($dispatcherEntity);

            return $clientDispatcher;
        }, $founds);
    }

    /** Filtro: notificações pendentes */
    public function pending()
    {
        return $this->where('status', 'PENDING');
    }

    /** Filtro: notificações enviadas com sucesso */
    public function successful()
    {
        return $this->where('status', 'SUCCESSFUL');
    }

    /** Filtro: por plataforma */
    public function byPlatform(string $platform)
    {
        return $this->where('platform', strtoupper($platform));
    }
}
