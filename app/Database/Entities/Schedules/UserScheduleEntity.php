<?php

namespace App\Database\Entities\Schedules;

use App\Database\Entities\Users\UserEntity;
use App\Traits\EntityEnhancerTrait;
use CodeIgniter\Entity\Entity;

class UserScheduleEntity extends Entity
{
    use EntityEnhancerTrait;

    protected $dates = [];
    public $attributes = [
        'user_id'         => null,
        'schedule_id'     => null,
    ];

    public $relations = [
        'user'          => null,
        'schedule'      => null,
    ];

    public function getUserId(): ?int
    {
        return $this->attributes['user_id'];
    }
    public function setUserId(?int $user_id): void
    {
        $this->attributes['user_id'] = $user_id;
    }

    public function getScheduleId(): ?int
    {
        return $this->attributes['schedule_id'];
    }
    public function setScheduleId(?int $schedule): void
    {
        $this->attributes['schedule_id'] = $schedule;
    }

    public function getUser(): ?UserEntity
    {
        return $this->relations['user'];
    }
    public function setUser(?UserEntity $user): void
    {
        $this->relations['user'] = $user;
    }

    public function getSchedule(): ?ScheduleEntity
    {
        return $this->relations['schedule'];
    }
    public function setSchedule(?ScheduleEntity $schedule): void
    {
        $this->relations['schedule'] = $schedule;
    }
}
