<?php

namespace App\Api\Operations\Clients\Trash\Post;

use App\Database\Models\Clients\ClientsModel;
use App\Libraries\Exceptions\Exceptions;
use App\Services\Notifications\NotificationsService;
use CodeIgniter\HTTP\Response;

class PostUseCases
{

    /**
     * @param array{
     *   in_ids: int
     * } $payload
     */
    public function execute(array $payload)
    {
        if (!isset($payload['in_ids']) || !is_array($payload['in_ids']))
            throw new Exceptions('Api.clients.invalid.in_ids', Response::HTTP_BAD_REQUEST);

        $clientsModel = new ClientsModel();
        $ids = $payload['in_ids'] ?? [];

        if (!empty($ids)) {
            $clientsModel
                ->whereIn('id', $ids)->withDeleted(true)
                ->set([
                    'status' => 'ACTIVE',
                    'deleted_at' => null
                ])
                ->update();
        }

        NotificationsService::store([
            "scope" => "clients",
            "action" => "DELETE"
        ]);
        return (object)[
            "success" => "Api.clients.trash.success.restore"
        ];
    }
}
