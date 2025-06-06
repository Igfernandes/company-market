<?php

namespace App\Services\CronJob\Entities;

use App\Services\CronJob\Entities\Schedule;

class Job
{
    private string $url = "";
    private string $title = "";
    private bool $enabled = true;
    private bool $saveResponses = false;
    private int $requestMethod = 1;
    private Schedule $schedule;

    public function getAttributes()
    {
        return [
            "url" => $this->url,
            "title" => $this->title,
            "enabled" => $this->enabled,
            "requestMethod" => $this->requestMethod,
            "saveResponses" => $this->saveResponses,
            "schedule" => $this->schedule->getAttributes()
        ];
    }

    public function getTitle(): string
    {
        return $this->title;
    }
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getRequestMethod(): int
    {
        return $this->requestMethod;
    }
    public function setRequestMethod(int $requestMethod): void
    {
        $this->requestMethod = $requestMethod;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }
    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    public function isSaveResponses(): bool
    {
        return $this->saveResponses;
    }
    public function setSaveResponses(bool $saveResponses): void
    {
        $this->saveResponses = $saveResponses;
    }

    public function getSchedule(): Schedule
    {
        return $this->schedule;
    }
    public function setSchedule(Schedule $schedule): void
    {
        $this->schedule = $schedule;
    }
}
