<?php

namespace App\Database\Entities\Schedules;

use CodeIgniter\Entity\Entity;
use App\Traits\EntityEnhancerTrait;

class ScheduleEntity extends Entity
{
    use EntityEnhancerTrait;

    public $attributes = [
        'id'            => null,
        'title'         => null,
        'describe'      => null,
        'color'         => null,
        'date'          => null,
        'end_date'      => null,
        'created_at'    => null,
        'updated_at'    => null
    ];

    public function getId(): ?int
    {
        return $this->attributes['id'];
    }
    public function setId(?int $id): void
    {
        $this->attributes['id'] = $id;
    }

    public function getTitle(): ?string
    {
        return $this->attributes['title'];
    }
    public function setTitle(?string $title): void
    {
        $this->attributes['title'] = $title;
    }

    public function getDescribe(): ?string
    {
        return $this->attributes['describe'];
    }
    public function setDescribe(?string $describe): void
    {
        $this->attributes['describe'] = $describe;
    }

    public function getColor(): ?string
    {
        return $this->attributes['color'];
    }
    public function setColor(?string $color): void
    {
        $this->attributes['color'] = $color;
    }

    public function getDate(): ?string
    {
        return $this->attributes['date'];
    }
    public function setDate(?string $date): void
    {
        $this->attributes['date'] = $date;
    }

    public function getEndDate(): ?string
    {
        return $this->attributes['end_date'];
    }

    public function setEndDate(?string $endDate): void
    {
        $this->attributes['endDate'] = $endDate;
    }

    public function getCreatedAt(): ?string
    {
        return $this->attributes['created_at'];
    }
    public function setCreatedAt(?string $datetime): void
    {
        $this->attributes['created_at'] = $datetime;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->attributes['updated_at'];
    }
    public function setUpdatedAt(?string $datetime): void
    {
        $this->attributes['updated_at'] = $datetime;
    }
}
