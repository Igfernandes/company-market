<?php

namespace App\Business\Messages;

use App\Database\Entities\Clients\ClientEntity;
use App\Database\Entities\Finances\ChargeEntity;
use App\Database\Entities\Services\ServiceEntity;

class MetaMessages
{
    public static function getChargeTemplate(ClientEntity $client, ChargeEntity $charge)
    {
        return "Olá {$client->getName()}, tudo bem? 😊
            Estamos passando para lembrar que a fatura referente ao {$charge->getTitle()} está disponível. 

            🗓 Vencimento: {$charge->getExpiredDays()}  
            💰 Valor: {$charge->getAmount()}

            Você pode acessar o boleto e realizar o pagamento através do link abaixo:  
            " . \getenv('globals.href.frontend') . "/checkout?charge=" . $charge->getId() . "

            Caso já tenha efetuado o pagamento, por favor, desconsidere esta mensagem.";
    }

    public static function getServiceTemplate(ServiceEntity $service)
    {
        $realizedDate = date("d/m/Y", \strtotime($service->getRealizedAt()));
        $realizedTime  =  date("H:i", \strtotime($service->getRealizedAt()));

        $details = "";
        if ($service->getAddress())
            $details .=  "\n 📍 Local: {$service->getAddress()}";

        if ($service->getRealizedAt())
            $details .= "\n 📅 Data: {$realizedDate}
        ⏰ Horário: {$realizedTime}";


        return "{$service->getName()}

        {$service->getDescription()}
        
        $details
        
        Se quiser garantir sua vaga ou saber mais, acesse: " . \getenv('globals.href.frontend') . "/services?key=" . $service->getId();
    }


    public static function getServiceToClientsTemplate(?ClientEntity $client, ServiceEntity $service)
    {
        $realizedDate = date("d/m/Y", \strtotime($service->getRealizedAt()));
        $realizedTime  =  date("H:i", \strtotime($service->getRealizedAt()));

        $details = "";
        if ($service->getAddress())
            $details .=  "\n 📍 Local: {$service->getAddress()}";

        if ($service->getRealizedAt())
            $details .= "\n 📅 Data: {$realizedDate}
        ⏰ Horário: {$realizedTime}";


        return "Olá {$client->getName()}, tudo bem? 😊
        Gostaríamos de te convidar para um evento especial que vai acontecer!.

        $details
        
        Se quiser garantir sua vaga ou saber mais, acesse: " . \getenv('globals.href.frontend') . "/services?key=" . $service->getId();
    }
}
