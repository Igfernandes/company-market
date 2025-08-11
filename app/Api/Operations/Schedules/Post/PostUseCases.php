<?php

namespace App\Api\Operations\Schedules\Post;

use App\Business\Schedules\SchedulesBusiness;
use App\Database\Entities\Schedules\ScheduleEntity;
use App\Database\Models\Schedules\SchedulesModel;
use App\Services\Notifications\NotificationsService;
use App\Traits\BusinessTrait;

class PostUseCases
{
    use BusinessTrait;

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

        $schedulesModel->save($scheduleEntity);

        \array_push($payload['linked'], $session->get('userAuthId'));

        if (\is_array($payload['linked'])) {
            $scheduleBusiness = new SchedulesBusiness();
            $scheduleBusiness->storeUsersWithSchedule($payload['linked'], $schedulesModel->getInsertID());
        }

        NotificationsService::store([
            "scope" => "schedules",
            "action" => "CREATE"
        ]);
        return (object)[
            "success" => "Api.schedules.success.post"
        ];
    }
}
