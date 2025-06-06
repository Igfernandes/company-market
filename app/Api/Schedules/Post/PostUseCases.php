<?php

namespace App\Api\Schedules\Post;

use App\Database\Entities\Schedules\ScheduleEntity;
use App\Database\Models\Schedules\SchedulesModel;
use App\Database\Models\Schedules\UsersSchedulesModel;
use App\Traits\BusinessTrait;
use App\Traits\Services\ServicesDataTrait;

class PostUseCases
{
    use ServicesDataTrait, BusinessTrait;

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
        $filteredPayload = \array_filter($payload, fn($field) => !empty($field));

        $schedulesModel = new SchedulesModel();
        $scheduleEntity = new ScheduleEntity();

        $scheduleEntity->store($filteredPayload);

        $schedulesModel->save($scheduleEntity);

        $usersScheduleModel = new UsersSchedulesModel();

        if (\is_array($payload['linked'])) {
            foreach ($payload['linked'] as $user) {
                $usersScheduleModel->save([
                    "user_id" => $user,
                    "schedule_id" => $schedulesModel->getInsertID()
                ]);
            }
        }


        return (object)[
            "success" => lang("Api.schedules.success.post")
        ];
    }
}
