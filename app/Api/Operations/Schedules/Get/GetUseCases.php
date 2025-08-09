<?php

namespace App\Api\Operations\Schedules\Get;

use App\Database\Entities\Schedules\ScheduleEntity;
use App\Database\Models\Schedules\SchedulesModel;
use App\Database\Models\Schedules\UsersSchedulesModel;
use App\Traits\BusinessTrait;
use App\Traits\Schedules\SchedulesDataTrait;

class GetUseCases
{
    use SchedulesDataTrait, BusinessTrait;

    /**
     * @param array{
     *     id: int,
     *     in_ids: array<int>, 
     *     title: string, 
     *     title_contains: string, 
     *     date: string, 
     *     end_date: string
     * } $payload
     */
    public function execute(array $payload)
    {
        $filteredPayload = \array_filter($payload, fn($field) => !empty($field));

        $schedulesModel = new SchedulesModel();

        $in_ids = isset($filteredPayload['in_ids']) ? $filteredPayload['in_ids'] : [];
        unset($filteredPayload['in_ids']);

        if (count($in_ids) > 0)
            $schedulesModel->whereIn("id", $in_ids);

        $schedulesModel = $this->builderClauseWithContains($payload, $schedulesModel);
        $foundSchedules = $schedulesModel->findAll();

        $usersSchedulesModel = new UsersSchedulesModel();

        $foundUsersSchedules = $usersSchedulesModel->getUsersWithSchedules([]);

        $schedulesData = array_map(
            fn(ScheduleEntity $schedule) => $this->builder($schedule, $foundUsersSchedules),
            $foundSchedules
        );

        return \array_values($schedulesData);
    }
}
