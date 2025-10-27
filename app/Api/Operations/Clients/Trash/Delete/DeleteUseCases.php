<?php

namespace App\Api\Operations\Clients\Trash\Delete;

use App\Business\Clients\ClientsBusiness;
use App\Database\Models\Clients\ClientsCategoriesModel;
use App\Database\Models\Clients\ClientsModel;
use App\Database\Models\CustomForms\ClientsFormsHistoryModel;
use App\Database\Models\Fields\ClientsFieldsModel;
use App\Libraries\Exceptions\Exceptions;
use App\Services\Notifications\NotificationsService;
use CodeIgniter\HTTP\Response;

class DeleteUseCases
{
    const REFERENCES_CLASS = [
        ClientsCategoriesModel::class,
        // ClientsFormsHistoryModel::class,
        ClientsFieldsModel::class
    ];

    /**
     * @param array{
     *   id: int
     * } $payload
     */
    public function execute(array $payload)
    {
        $clientsBusiness = new ClientsBusiness();

        $clientId = $payload['id'];

        if (!$clientsBusiness->has([
            "id" => $clientId
        ]))
            throw new Exceptions("Api.clients.invalid.not_found", Response::HTTP_NOT_ACCEPTABLE);

        $clientsModel = new ClientsModel();

        foreach (SELF::REFERENCES_CLASS as $instances) {
            $model = new $instances();

            $model->where("client_id", $clientId)->delete();
        }

        $clientsModel->withDeleted()->delete($clientId, true);

        NotificationsService::store([
            "scope" => "clients",
            "action" => "DELETE"
        ]);
        return (object)[
            "success" => "Api.clients.trash.success.delete"
        ];
    }
}
