<?php

namespace App\WebSocket;

use CodeIgniter\CLI\CLI;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class InstanceServer implements MessageComponentInterface
{
    protected $channels = [];

    public function onOpen(ConnectionInterface $conn)
    {
        CLI::write("Nova conexão ID: {$conn->resourceId}\n", 'yellow');
        $this->channels['default'][$conn->resourceId] = $conn;
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        CLI::write("FROM: {$from}, MESSAGE: {$msg}\n", 'yellow');
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

        CLI::write("MESSAGE_SEND\n", 'yellow');
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

        CLI::write("CLOSED CONNECT", 'yellow');
        $conn->close();
    }

    public function send($channel, $message)
    {
        if (!empty($this->channels[$channel])) {
            foreach ($this->channels[$channel] as $conn) {
                $conn->send($message);
            }
        }
        CLI::write("SEND MESSAGE");
    }
}
