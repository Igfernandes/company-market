<?php

namespace App\Api\Operations\Attempts\Contact\Post;

use App\Services\Mailer\Mailers\FeedbackMail;
use App\Services\Mailer\Mailers\SubscribeMail;
use App\Traits\BusinessTrait;
use App\Traits\CustomForms\CustomFormsDataTrait;

class PostUseCases
{
    use CustomFormsDataTrait, BusinessTrait;

    /**
     * @param array{
     *     name: string, 
     *     email: string,
     *     subject: string,
     *     message: string,
     * } $payload
     */
    public function execute(array $payload)
    {
        $subscribeMail = new SubscribeMail();
        $subscribeMail->send([
            "recipients" => [
                [
                    "email" => $payload['email'],
                    "name" => "Novo Inscrito"
                ]
            ],
            "email" => $payload['email']
        ]);

        FeedbackMail::send([
            "recipients" => [
                [
                    "email" => "companymarketbanks@gmail.com",
                    "name" => "Central"
                ],
                [
                    "email" => "matheustheodoro27@gmail.com",
                    "name" => "Matheus"
                ]
            ],
            "data" => $payload
        ]);
        return (object)[
            "success" => "Api.contact.success.post"
        ];
    }
}
