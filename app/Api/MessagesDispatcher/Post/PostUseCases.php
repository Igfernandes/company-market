<?php

namespace App\Api\MessagesDispatcher\Post;

use App\Business\Clients\ClientsBusiness;
use App\Business\MessagesDispatcher\MessagesDispatcherBusiness;
use App\Business\MessagesDispatcher\ScheduleDispatcherBusiness;
use App\Database\Entities\MessagesDispatcher\MessageDispatcherEntity;
use App\Database\Models\MessagesDispatcher\MessagesDispatcherModel;
use App\Libraries\Exceptions\Exceptions;
use App\Services\CronJob\CronJobService;
use App\Services\CronJob\Entities\Job;
use App\Services\CronJob\Entities\Schedule;
use App\Services\Notifications\NotificationsService;
use App\Traits\BusinessTrait;
use DateTime;

class PostUseCases
{
    use BusinessTrait;

    /**
     * @param array{
     *     title: string,
     *     weekday: 'SUNDAY'| 'MONDAY'| 'TUESDAY'| 'WEDNESDAY'| 'THURSDAY'| 'FRIDAY'| 'SATURDAY',
     *     period:  'DAILY' | 'WEEKLY' | 'MONTHLY',
     *     content: string,
     *     platforms: array{'FACEBOOK' | 'INSTAGRAM' | 'WHATSAPP' | 'EMAIL' | 'SMS'},
     *     scheduled_at: string,
     *     started_at: string, 
     *     service_id: integer, 
     *     charge_id: integer, 
     *     clients: array{integer}
     * } $payload
     */
    public function execute(array $payload)
    {
        $session = session();

        $userAuthId = $session->get('userAuthId');
        $messagesDispatcherBusiness = new MessagesDispatcherBusiness();

        $clientsBusiness = new ClientsBusiness();
        $availablePlatforms = ['FACEBOOK', 'INSTAGRAM', 'WHATSAPP', 'EMAIL'];
        $foundPlatforms = \array_filter($payload['platforms'], fn($platform) => array_search($platform, $availablePlatforms) !== false);

        if (\count($foundPlatforms) == 0)
            throw new Exceptions(\str_replace("{field}", "platform", lang("Validation.required")), BAD_BUSINESS_RULES);

        if (!$messagesDispatcherBusiness->hasContentToSend($payload))
            throw new Exceptions(\str_replace("{field}", "conteúdo", lang("Validation.not_found")), BAD_BUSINESS_RULES);

        if (empty($payload['clients']) || !$clientsBusiness->hasClients($payload['clients']))
            throw new Exceptions("Será necessário fornecer clientes que receberam a notificação", BAD_BUSINESS_RULES);

        $messagesDispatcherModel = new MessagesDispatcherModel();
        $messageDispatcherEntity = new MessageDispatcherEntity();

        $messageDispatcherEntity->setTitle($payload['title']);
        $messageDispatcherEntity->setPeriod($payload['period']);
        $messageDispatcherEntity->setStartedAt($payload['started_at'] ?: date("Y-m-d H:i:s"));
        $messageDispatcherEntity->setScheduledDay($payload['scheduled_day']);
        $messageDispatcherEntity->setPlatforms($payload['platforms']);
        $messageDispatcherEntity->setContent($payload['content']);
        $messageDispatcherEntity->setWeekday($payload['weekday']);

        $messageDispatcherEntity->setServiceId($payload['service_id']);
        $messageDispatcherEntity->setChargeId($payload['charge_id']);
        $messageDispatcherEntity->setAuthorId($userAuthId);

        $messageDispatcherEntity->setReference(md5($payload['title'] . date("YmdHS")));
        $messagesDispatcherModel->save($messageDispatcherEntity->toArray(true));
        $dispatcherId = $messagesDispatcherModel->getInsertID();

        $messageDispatcherEntity->setId($dispatcherId);
        $startedDate = new DateTime($messageDispatcherEntity->getStartedAt());

        if ($messageDispatcherEntity->getPeriod() || $startedDate > new DateTime('now')) {
            $scheduleDispatcherBusiness = new ScheduleDispatcherBusiness();
            $scheduleDispatcherBusiness->schedule($messageDispatcherEntity);
            ScheduleDispatcherBusiness::scheduleDispatcherClients($payload['clients'], $messageDispatcherEntity);
        }

        if ($startedDate <= new DateTime('now'))
            $messagesDispatcherBusiness->send($payload['clients'], $messageDispatcherEntity);

        NotificationsService::store([
            "scope" => "dispatcher",
            "action" => "CREATE"
        ]);

        return (object)[
            "success" => lang("Api.dispatcher.success.post")
        ];
    }
}
