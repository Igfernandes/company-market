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
        echo "Nova conexão ID: {$conn->resourceId}\n";
        $this->channels['default'][$conn->resourceId] = $conn;
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        // Enviar para todos no canal
        foreach ($this->channels as $channel => $connections) {
            if (isset($connections[$from->resourceId])) {
                foreach ($connections as $conn) {
                    if ($conn !== $from) {
                        $conn->send($msg);
                    }
                }
                break;
            }
        }
        echo "Mensagem retransmitida: $msg\n";
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
