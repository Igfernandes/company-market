<?php

namespace App\Services\CronJob\Entities;

class Schedule
{
    private string $timezone = "America/Sao_Paulo";
    private int $expiresAt = 0;
    private array $hours = [-1];
    private array $mdays = [-1];
    private array $minutes = [-1];
    private string $startDate = "";
    private array $months = [-1];
    private array $wdays = [-1];

    public function getAttributes()
    {
        return [
            "timezone" => $this->getTimezone(),
            "expiresAt" => $this->getExpiresAt(),
            "hours" => $this->getHours(),
            "mdays" => $this->getMdays(),
            "minutes" => $this->getMinutes(),
            "startDate" => $this->getStartDate(),
            "months" => $this->getMonths(),
            "wdays" => $this->getWdays()
        ];
    }

    public function getTimezone(): string
    {
        return $this->timezone;
    }
    public function setTimezone(string $timezone): void
    {
        $this->timezone = $timezone;
    }

    public function getExpiresAt(): int
    {
        return $this->expiresAt;
    }
    public function setExpiresAt(int $expiresAt): void
    {
        $this->expiresAt = $expiresAt;
    }

    public function getHours(): array
    {
        return $this->hours;
    }
    public function setHours(array $hours): void
    {
        $this->hours = $hours;
    }

    public function getMdays(): array
    {
        return $this->mdays;
    }
    public function setMdays(array $mdays): void
    {
        $this->mdays = $mdays;
    }

    public function getMinutes(): array
    {
        return $this->minutes;
    }
    public function setMinutes(array $minutes): void
    {
        $this->minutes = $minutes;
    }



    public function getStartDate(): string
    {
        return $this->startDate;
    }
    public function setStartDate(string $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getMonths(): array
    {
        return $this->months;
    }
    public function setMonths(array $months): void
    {
        $this->months = $months;
    }

    public function getWdays(): array
    {
        return $this->wdays;
    }
    public function setWdays(array $wdays): void
    {
        $this->wdays = $wdays;
    }
}
