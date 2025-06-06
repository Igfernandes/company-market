<?php

namespace App\Traits\Schedules;

use App\Database\Entities\Schedules\ScheduleEntity;
use App\Database\Entities\Schedules\UserScheduleEntity;

trait SchedulesDataTrait
{
    public function builder(ScheduleEntity $schedule, array $userSchedule): Object
    {
        $foundUsers = \array_map(fn(UserScheduleEntity $userSchedule) => (object)[
            "id" => $userSchedule->getUserId(),
            "name" => $userSchedule->getUser()->getName()
        ], $userSchedule);

        return  (object)[
            "id" => $schedule->getId(),
            "title" => $schedule->getTitle(),
            "describe" => $schedule->getDescribe(),
            "color" => $schedule->getColor(),
            "date" => $schedule->getDate(),
            "end_date" => $schedule->getEndDate(),
            "linked" => $foundUsers,
            "created_at" => $schedule->getCreatedAt(),
            "updated_at" => $schedule->getUpdatedAt()
        ];
    }
}
