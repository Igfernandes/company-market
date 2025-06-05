<?php

namespace App\Services\Mailer\Mailers;

use App\Database\Entities\Services\ServiceEntity;
use App\Database\Models\Services\ServicesModel;
use App\Services\Mailer\MailService;
use App\Services\Mailer\OptionsMail;

class ServiceMail
{

    /**
     * @param array{
     *  serviceId: int,
     *  recipients:array{array{
     *  email:string,
     *  name:string
     *  }},
     * } $payload
     */
    public function send(array $payload): bool
    {
        helper('files');
        $mailService = new MailService();
        $optionsMail = new OptionsMail();
        $servicesModel = new ServicesModel();

        /** @var ServiceEntity */
        $service = $servicesModel->where('id', $payload['serviceId'])->first();

        if (empty($service))
            return false;

        $optionsMail->title = $service->getName() . " - " . \getenv('system.mail.author');
        $optionsMail->recipients = $payload['recipients'];

        $serviceId =  $payload['serviceId'];
        $query = "/services?key=$serviceId";
        $link = getenv('globals.href.frontend') . $query;

        $optionsMail->html = (string) view('mails/services', [
            'serviceId' => $serviceId,
            "title" => $service->getName(),
            'link' => $link,
            'description' => $service->getDescription(),
            'image' => \getPublicUrl($service->getPhoto())
        ]);

        $optionsMail->textHtml = "Olá, você recebeu um cobrança da plataforma " . \getenv('system.mail.author') . "! Acesse o link: $link";

        $mailService->send($optionsMail);

        return true;
    }
}
