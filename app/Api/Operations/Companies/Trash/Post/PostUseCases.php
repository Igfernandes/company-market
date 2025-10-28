<?php

namespace App\Api\Operations\Companies\Trash\Post;

use App\Database\Models\Companies\CompaniesModel;
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
            throw new Exceptions('Api.companies.invalid.in_ids', Response::HTTP_BAD_REQUEST);

        $companiesModel = new CompaniesModel();
        $ids = $payload['in_ids'] ?? [];

        if (!empty($ids)) {
            $companiesModel
                ->whereIn('id', $ids)->withDeleted(true)
                ->set([
                    'status' => 'ACTIVE',
                    'deleted_at' => null
                ])
                ->update();
        }

        NotificationsService::store([
            "scope" => "companies",
            "action" => "DELETE"
        ]);
        return (object)[
            "success" => "Api.companies.trash.success.restore"
        ];
    }
}
