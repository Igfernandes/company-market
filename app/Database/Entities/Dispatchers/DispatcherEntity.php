<?php

namespace App\Database\Entities\Dispatchers;

use CodeIgniter\Entity\Entity;
use App\Traits\EntityEnhancerTrait;

class DispatcherEntity extends Entity
{
    use EntityEnhancerTrait;
    protected $dates = [];
    public $attributes = [
        'id'            => null,
        'title'         => null,
        'content'       => null,
        'period'        => null,
        'platforms'     => null,
        'status'        => null,
        'scheduled_at'  => null,
        'weekday'       => null,
        'started_at'    => null,
        'content_id'    => null,
        'author_id'     => null,
        'reference'     => null,
        'created_at'    => null,
        'updated_at'    => null,
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

    public function getContent(): ?string
    {
        return $this->attributes['content'];
    }
    public function setContent(?string $content): void
    {
        $this->attributes['content'] = $content;
    }

    public function getPeriod(): ?string
    {
        return $this->attributes['period'];
    }
    public function setPeriod(?string $period): void
    {
        $this->attributes['period'] = $period;
    }

    public function getPlatforms(): ?string
    {
        return $this->attributes['platforms'];
    }
    public function setPlatforms($platforms): void
    {
        $this->attributes['platforms'] = is_array($platforms) ? implode(',', $platforms) : $platforms;
    }

    public function getStatus(): ?string
    {
        return $this->attributes['status'];
    }
    public function setStatus(?string $status): void
    {
        $this->attributes['status'] = $status;
    }

    public function getScheduledDay(): ?string
    {
        return $this->attributes['scheduled_day'];
    }
    public function setScheduledDay(?string $date): void
    {
        $this->attributes['scheduled_day'] = $date;
    }

    public function getWeekday(): ?string
    {
        return $this->attributes['weekday'];
    }
    public function setWeekday(null|string|array $weekday): void
    {
        $this->attributes['weekday'] = is_array($weekday) ? implode(',', $weekday) : $weekday;
    }

    public function getStartedAt(): ?string
    {
        return $this->attributes['started_at'];
    }
    public function setStartedAt(?string $datetime): void
    {
        $this->attributes['started_at'] = $datetime;
    }

    public function getContentId(): ?int
    {
        return $this->attributes['content_id'];
    }

    public function setContentId(?int $contentId): void
    {
        $this->attributes['content_id'] = $contentId;
    }

    public function getAuthorId(): ?int
    {
        return $this->attributes['author_id'];
    }

    public function setAuthorId(int $authorId): void
    {
        $this->attributes['author_id'] = $authorId;
    }


    public function getReference(): ?string
    {
        return $this->attributes['reference'];
    }

    public function setReference(?string $reference): void
    {
        if (!empty($reference)) {
            $this->attributes['reference'] = $reference;
        }
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
