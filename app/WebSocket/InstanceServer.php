<?php

namespace App\WebSocket;

use App\Business\Authentication\UserAuthHistoryBusiness;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class InstanceServer implements MessageComponentInterface
{
    protected $channels = [];

    public function onOpen(ConnectionInterface $conn)
    {
        $queryParams = [];
        parse_str($conn->httpRequest->getUri()->getQuery(), $queryParams);
        $tokenNavigation = $queryParams['token-navigation'] ?? "";
        $channel =  $queryParams['channel'] ?? "";

        if (empty($tokenNavigation))
            return $conn->close();

        $userAuthHistoryBusiness = new UserAuthHistoryBusiness();
        $isAuthUser = $userAuthHistoryBusiness->handleAuthNavigation($tokenNavigation);

        if ($isAuthUser === false)
            return $conn->close();

        $this->channels[$channel][$conn->resourceId] = $conn;
        echo "Usuário $tokenNavigation conectado com ID {$conn->resourceId}\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        // Espera-se que o client nunca envie mensagem neste caso
        echo "Mensagem recebida: $msg\n";
    }

    public function onClose(ConnectionInterface $conn)
    {
        foreach ($this->channels as $channel => $connections) {
            if (isset($connections[$conn->resourceId])) {
                unset($this->channels[$channel][$conn->resourceId]);
                echo "Conexão encerrada $channel\n";
                break;
            }
        }
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "Erro: {$e->getMessage()}\n";
        $conn->close();
    }

    public function send($channel, $message)
    {
        if (!empty($this->channels[$channel])) {
            foreach ($this->channels[$channel] as $conn) {
                $conn->send($message);
            }
        }
    }
}
