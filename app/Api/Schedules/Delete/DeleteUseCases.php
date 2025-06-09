<?php

namespace App\Api\Schedules\Delete;

use App\Database\Models\Schedules\SchedulesModel;
use App\Database\Models\Schedules\UsersSchedulesModel;
use App\Libraries\Exceptions\Exceptions;
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
            'schedule_id' => $payload['id'],
            'user_id' =>  $session->get('userAuthId')
        ])->first();

        if (empty($foundAuthorInSchedule))
            throw new Exceptions(\str_replace("{field}", "Agendamento", lang('Validation.not_found')), \BAD_BUSINESS_RULES);

        $schedulesModel->where($payload)->delete();
        $usersScheduleModel->where([
            'schedule_id' => $payload['id']
        ])->delete();

        return (object)[
            "success" => lang("Api.schedules.success.post")
        ];
    }
}
