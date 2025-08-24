<?php

namespace App\Business\MessagesDispatcher;

use App\Database\Entities\MessagesDispatcher\ClientMessageDispatcherEntity;
use App\Database\Entities\MessagesDispatcher\MessageDispatcherEntity;
use App\Database\Models\MessagesDispatcher\ClientsMessagesDispatcherModel;
use App\Services\CronJob\CronJobService;
use App\Services\CronJob\Entities\Job;
use App\Services\CronJob\Entities\Schedule;
use DateTime;
use DateTimeZone;

class ScheduleDispatcherBusiness
{
    public static function schedule(MessageDispatcherEntity $dispatcher)
    {
        $cronJobService = new CronJobService();

        $job = new Job();
        $job->setUrl(base_url("/api/webhook/tasks/dispatcher?k={$dispatcher->getReference()}"));

        $job->setTitle("Task-dispatcher:" . $dispatcher->getId());
        $schedule = new Schedule();

        $startedDatetime = new DateTime($dispatcher->getStartedAt(), new DateTimeZone('America/Sao_Paulo'));

        $startedDatetimeUTC = clone $startedDatetime;
        $startedDatetimeUTC->setTimezone(new DateTimeZone('UTC'));

        $schedule->setStartDate($startedDatetimeUTC->format('Y-m-d\TH:i:s\Z'));
        $schedule->setHours([$startedDatetime->format("H")]);
        $schedule->setMinutes([$startedDatetime->format("i")]);

        switch ($dispatcher->getPeriod()) {
            case "DAILY":
                $schedule->setExpiresAt(0);
                break;
            case "WEEKLY":
                if ($dispatcher->getWeekday()) {
                    $weekdays = \explode(",", $dispatcher->getWeekday());

                    $schedule->setWdays(\array_map(fn($weekday) => WEEKDAYS[$weekday], $weekdays));
                }
                break;
            case "MONTHLY":
                $schedule->setMdays([$dispatcher->getScheduledDay()]);
                break;
            default:
                $schedule->setMinutes([$startedDatetime->format('i')]);
                $schedule->setHours([$startedDatetime->format('H')]);
                $schedule->setMdays([$startedDatetime->format('j')]);
                $schedule->setMonths([$startedDatetime->format('n')]);
                $schedule->setExpiresAt($startedDatetime->format('YmdHis'));
                break;
        }

        $job->setSchedule($schedule);
        $cronJobService->store($job);
    }

    public static function scheduleDispatcherClients(array $clientIds, MessageDispatcherEntity $dispatcher)
    {
        $clientsMessagesDispatcherModel = new ClientsMessagesDispatcherModel();
        $clientRegisters = [];

        $platforms = \explode(",", $dispatcher->getPlatforms());
        $clientsDispatchers = $clientsMessagesDispatcherModel->where("status", "PENDING")->whereIn("client_id", $clientIds)->findAll();

        $clientsIdsAlreadyScheduled = \array_map(fn(ClientMessageDispatcherEntity $clientDispatcher) => $clientDispatcher->getClientId(), $clientsDispatchers);

        foreach ($platforms as $platform) {
            foreach ($clientIds as $clientId) {
                $clientMessageEntity = new ClientMessageDispatcherEntity();

                if (\in_array($clientId, $clientsIdsAlreadyScheduled))
                    continue;

                $clientMessageEntity->setMessageId($dispatcher->getId());
                $clientMessageEntity->setPlatform($platform);
                $clientMessageEntity->setStatus("PENDING");

                $clientMessageEntity->setClientId($clientId);

                array_push($clientRegisters, $clientMessageEntity->toArray(true));
            }

            if (\count($clientRegisters) > 0)
                $clientsMessagesDispatcherModel->insertBatch($clientRegisters);
        }
    }


    public function delete(MessageDispatcherEntity $dispatcher)
    {
        $cronJobService = new CronJobService();

        $response = $cronJobService->search();

        if (!isset($response->jobs))
            return false;

        $currentJob = null;
        foreach ($response->jobs as $job) {
            if ($job->title == "Task-dispatcher:{$dispatcher->getId()}")
                $currentJob = $job;
        }

        if (empty($currentJob))
            return false;

        return $cronJobService->delete($currentJob->jobId);
    }
}
