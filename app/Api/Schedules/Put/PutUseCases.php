<?php

namespace App\Api\Schedules\Put;

use App\Business\Schedules\SchedulesBusiness;
use App\Database\Entities\Schedules\ScheduleEntity;
use App\Database\Models\Schedules\SchedulesModel;
use App\Services\Notifications\NotificationsService;
use App\Traits\BusinessTrait;

class PutUseCases
{
    use  BusinessTrait;

    /**
     * @param array{
     *     title: string, 
     *     describe: string,
     *     color: string, 
     *     date: string,
     *     end_date: string,
     *     linked: array{int}
     * } $payload
     */
    public function execute(array $payload)
    {
        $session = session();
        $filteredPayload = \array_filter($payload, fn($field) => !empty($field));

        $schedulesModel = new SchedulesModel();
        $scheduleEntity = new ScheduleEntity();

        $scheduleEntity->store($filteredPayload);

        $schedulesModel->set($scheduleEntity->toArray(true))->where('id', $filteredPayload['id'])->update();

        \array_push($payload['linked'], $session->get('userAuthId'));

        if (\is_array($payload['linked'])) {
            $scheduleBusiness = new SchedulesBusiness();
            $scheduleBusiness->storeUsersWithSchedule($payload['linked'], $filteredPayload['id']);
        }

        NotificationsService::store([
            "scope" => "schedules",
            "action" => "UPDATE"
        ]);

        return (object)[
            "success" => "Api.schedules.success.put"
        ];
    }
}
