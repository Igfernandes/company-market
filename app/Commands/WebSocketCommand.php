<?php

// app/Commands/WebSocket.php
namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use App\WebSocket\InstanceServer;

class WebSocketCommand extends BaseCommand
{
    protected $group       = 'Custom';
    protected $name        = 'websocket';
    protected $description = 'Start the WebSocket server';

    public function run(array $params)
    {
        $PORT = getenv('websocket.port');
        CLI::write("Iniciando servidor WebSocket em ws://localhost:$PORT", 'green');

        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new InstanceServer()
                )
            ),
            $PORT
        );

        $server->run();
    }
}
