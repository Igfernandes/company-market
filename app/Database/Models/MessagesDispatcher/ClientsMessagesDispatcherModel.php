<?php

namespace App\Database\Models\MessagesDispatcher;

use App\Database\Entities\Clients\ClientEntity;
use App\Database\Entities\MessagesDispatcher\ClientMessageDispatcherEntity;
use App\Database\Entities\MessagesDispatcher\MessageDispatcherEntity;
use App\Traits\ModelTrait;
use CodeIgniter\Model;

class ClientsMessagesDispatcherModel extends Model
{

    use ModelTrait;

    protected $table            = 'clients_messages_dispatcher';
    protected $primaryKey       = 'id';
    protected $useSoftDeletes   = false;
    protected $returnType       = 'App\Database\Entities\MessagesDispatcher\ClientMessageDispatcherEntity';

    protected $allowedFields = [
        'client_id',
        'message_id',
        'status',
        'platform',
        'log_error',
        'send_at',
        'created_at',
    ];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';


    public function getClientsWithMessages(array $clientQuery, array $messageQuery = [], array $clientsMessagesQuery = []): array
    {
        $clientQueryUpdated = $this->addPrefixInQuery($clientQuery, "clients");
        $messageDispatcherQueryUpdated = $this->addPrefixInQuery($messageQuery, "messages_dispatcher");
        $clientsMessageDispatcherQueryUpdated = $this->addPrefixInQuery($clientsMessagesQuery, "clients_messages_dispatcher");

        $founds = $this->select(" clients.*, messages_dispatcher.*, clients_messages_dispatcher.*,
        clients.name as client_name, clients.id as client_id, clients.created_at as client_created_at, 
        clients.updated_at as client_updated_at,
        messages_dispatcher.id as message_id, messages_dispatcher.created_at as message_created_at,
        messages_dispatcher.updated_at as message_updated_at")
            ->join("clients", "clients.id = clients_messages_dispatcher.client_id")
            ->join("messages_dispatcher", "messages_dispatcher.id = clients_messages_dispatcher.message_id")
            ->where($clientQueryUpdated)
            ->where($messageDispatcherQueryUpdated)
            ->where($clientsMessageDispatcherQueryUpdated)->findAll();

        return array_map(function (ClientMessageDispatcherEntity $clientDispatcherData) {
            $clientDispatcher = new ClientMessageDispatcherEntity();
            $clientEntity = new ClientEntity();
            $messageDispatcherEntity = new MessageDispatcherEntity();

            /** @var array */
            $attributes = $clientDispatcherData->attributes;

            $clientEntity->store($attributes);
            $clientEntity->setId($attributes['client_id']);
            $clientEntity->setName($attributes['client_name']);
            $clientEntity->setCreatedAt($attributes['client_created_at']);
            $clientEntity->setUpdatedAt($attributes['client_updated_at']);

            $messageDispatcherEntity->store($attributes);
            $messageDispatcherEntity->setId($attributes['message_id']);
            $messageDispatcherEntity->setCreatedAt($attributes['message_created_at']);
            $messageDispatcherEntity->setUpdatedAt($attributes['message_updated_at']);

            $clientDispatcher->store($attributes);
            $clientDispatcher->setClientId($attributes['client_id']);
            $clientDispatcher->setMessageId($attributes['message_id']);
            $clientDispatcher->setClient($clientEntity);
            $clientDispatcher->setMessage($messageDispatcherEntity);

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
