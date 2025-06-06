<?php

namespace App\Database\Models\Schedules;

use App\Database\Entities\Schedules\ScheduleEntity;
use App\Database\Entities\Schedules\UserScheduleEntity;
use App\Database\Entities\Users\UserEntity;
use App\Traits\ModelTrait;
use CodeIgniter\Model;

class UsersSchedulesModel extends Model
{
    use ModelTrait;

    protected $table            = 'users_schedules';
    protected $primaryKey       = 'id';
    protected $useSoftDeletes   = false;
    protected $returnType       = 'App\Database\Entities\Schedules\UserScheduleEntity';

    protected $allowedFields = [
        'user_id',
        'schedule_id'
    ];

    protected $useTimestamps = false;
    protected $skipValidation = true;


    public function getUsersWithSchedules(array $userQuery, array $scheduleQuery = [], array $usersSchedulesQuery = []): array
    {
        $usersQueryUpdated = $this->addPrefixInQuery($userQuery, "users");
        $schedulesQueryUpdated = $this->addPrefixInQuery($scheduleQuery, "schedules");
        $usersSchedulesQueryUpdated = $this->addPrefixInQuery($usersSchedulesQuery, "users_schedules");

        $founds = $this->select(" users.*, schedules.*,
        users.name as user_name, users.id as user_id, users.created_at as user_created_at, 
        users.updated_at as user_updated_at,
        schedules.id as schedule_id, schedules.created_at as schedule_created_at,
        schedules.updated_at as schedule_updated_at")
            ->join("users", "users.id = users_schedules.user_id")
            ->join("schedules", "schedules.id = users_schedules.schedule_id")
            ->where($usersQueryUpdated)
            ->where($schedulesQueryUpdated)
            ->where($usersSchedulesQueryUpdated)->findAll();

        return array_map(function (UserScheduleEntity $userSchedulesData) {
            $userScheduleEntity = new UserScheduleEntity();
            $userEntity = new UserEntity();
            $scheduleEntity = new ScheduleEntity();

            /** @var array */
            $attributes = $userSchedulesData->attributes;

            $userEntity->store($attributes);
            $userEntity->setId($attributes['user_id']);
            $userEntity->setName($attributes['user_name']);
            $userEntity->setCreatedAt($attributes['user_created_at']);
            $userEntity->setUpdatedAt($attributes['user_updated_at']);

            $scheduleEntity->store($attributes);
            $scheduleEntity->setId($attributes['schedule_id']);
            $scheduleEntity->setCreatedAt($attributes['schedule_created_at']);
            $scheduleEntity->setUpdatedAt($attributes['schedule_updated_at']);

            $userScheduleEntity->setUserId($attributes['user_id']);
            $userScheduleEntity->setScheduleId($attributes['schedule_id']);
            $userScheduleEntity->setUser($userEntity);
            $userScheduleEntity->setSchedule($scheduleEntity);

            return $userScheduleEntity;
        }, $founds);
    }
}
