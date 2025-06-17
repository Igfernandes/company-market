<?php

// app/Commands/WebSocket.php
namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use App\WebSocket\InstanceServer;
use React\EventLoop\Loop;
use React\Socket\SocketServer;
use React\Socket\SecureServer;

class WebSocketCommand extends BaseCommand
{
    protected $group       = 'Custom';
    protected $name        = 'websocket';
    protected $description = 'Start the WebSocket server';

    public function run(array $params)
    {
        $PORT = getenv('websocket.port') ?: 8082;

        $loop = Loop::get();
        $socket = new SocketServer("0.0.0.0:$PORT", [], $loop);

        CLI::write("Iniciando servidor WebSocket em ws://localhost:$PORT", 'green');

        if (\getenv("CI_ENVIRONMENT") === "production") {
            $secureSocket = new SecureServer($socket, $loop, [
                'local_cert'        => '/caminho/para/fullchain.pem',
                'local_pk'          => '/caminho/para/privkey.pem',
                'allow_self_signed' => true,
                'verify_peer'       => false,
            ]);

            $server = new IoServer(
                new HttpServer(
                    new WsServer(
                        new InstanceServer()
                    )
                ),
                $secureSocket,
                $loop
            );
        } else {
            $server = new IoServer(
                new HttpServer(
                    new WsServer(
                        new InstanceServer()
                    )
                ),
                $socket,
                $loop
            );
        }

        $server->run();
    }
}
