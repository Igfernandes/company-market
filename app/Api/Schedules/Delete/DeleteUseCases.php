<?php

namespace App\Api\Schedules\Delete;

use App\Database\Models\Schedules\SchedulesModel;
use App\Database\Models\Schedules\UsersSchedulesModel;
use App\Libraries\Exceptions\Exceptions;
use App\Services\Notifications\NotificationsService;
use App\Traits\BusinessTrait;

class DeleteUseCases
{
    use  BusinessTrait;

    /**
     * @param array{
     *     id: number
     * } $payload
     */
    public function execute(array $payload)
    {
        $session = session();
        $filteredPayload = \array_filter($payload, fn($field) => !empty($field));

        $schedulesModel = new SchedulesModel();
        $usersScheduleModel = new UsersSchedulesModel();

        $foundAuthorInSchedule = $usersScheduleModel->where([
            'schedule_id' => $filteredPayload['id'],
            'user_id' =>  $session->get('userAuthId')
        ])->first();

        if (empty($foundAuthorInSchedule))
            throw new Exceptions("Api.schedules.invalid.not_found", \BAD_BUSINESS_RULES);

        $schedulesModel->where($filteredPayload)->delete();
        $usersScheduleModel->where([
            'schedule_id' => $filteredPayload['id']
        ])->delete();

        NotificationsService::store([
            "scope" => "schedules",
            "action" => "DELETE"
        ]);

        return (object)[
            "success" => "Api.schedules.success.delete"
        ];
    }
}
