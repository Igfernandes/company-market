<?php

namespace App\Business\Charges;

use App\Database\Entities\Finances\ChargeEntity;
use App\Services\CronJob\CronJobService;
use App\Services\CronJob\Entities\Job;
use App\Services\CronJob\Entities\Schedule;
use DateInterval;
use DateTime;
use DateTimeZone;

class ChargeScheduleBusiness
{
    public static function schedule(ChargeEntity $charge, string $startDate = "")
    {
        $cronJobService = new CronJobService();
        $period = $charge->getPeriod();

        $job = new Job();
        $schedule = new Schedule();

        $startedDatetimeUTC = new DateTime($startDate);
        $startedDatetimeUTC->setTimezone(new DateTimeZone('UTC'));
        $startedDatetimeUTC->add(new DateInterval("P{$period}M"));

        $schedule->setMinutes([$startedDatetimeUTC->format('i')]);
        $schedule->setHours([$startedDatetimeUTC->format('H')]);
        $schedule->setMdays([$startedDatetimeUTC->format('d')]);
        $schedule->setMonths([$startedDatetimeUTC->format('m')]);

        $schedule->setExpiresAt($startedDatetimeUTC->format('YmdHis'));

        $job->setTitle("Task-charge:{$charge->getId()}");
        $job->setSchedule($schedule);
        $job->setUrl(getenv('globals.href.backend') . "/api/webhook/tasks/charge?k={$charge->getReference()}");

        $cronJobService->store($job);
    }

    public static function delete(ChargeEntity $charge)
    {
        $cronJobService = new CronJobService();

        $response = $cronJobService->search();

        if (!isset($response->jobs))
            return false;

        $currentJob = null;
        foreach ($response->jobs as $job) {
            if ($job->title == "Task-charge:{$charge->getId()}")
                $currentJob = $job;
        }

        if (empty($currentJob))
            return false;

        return $cronJobService->delete($currentJob->jobId);
    }
}
