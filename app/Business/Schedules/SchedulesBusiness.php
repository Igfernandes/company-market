<?php

namespace App\Business\Schedules;

use App\Business\BaseBusiness;
use App\Database\Entities\Schedules\UserScheduleEntity;
use App\Database\Models\Schedules\SchedulesModel;
use App\Database\Models\Schedules\UsersSchedulesModel;

class SchedulesBusiness
{
    use BaseBusiness;

    private SchedulesModel $schedulesModel;
    private UsersSchedulesModel $usersSchedulesModel;

    public function __construct()
    {
        $this->schedulesModel = new SchedulesModel();
        $this->usersSchedulesModel = new UsersSchedulesModel();
    }

    public function storeUsersWithSchedule(array $users, int $scheduleId)
    {
        foreach ($users as $user) {
            $userScheduleEntity = new UserScheduleEntity();
            $userScheduleEntity->store([
                "user_id" => $user,
                "schedule_id" => $scheduleId
            ]);

            $this->usersSchedulesModel->upsert($userScheduleEntity->toArray(true), $userScheduleEntity);
        }
    }
}
