<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class RunCommand extends BaseCommand
{
    protected $group       = 'Inicialize';
    protected $name        = 'run';
    protected $description = 'Serve a aplicação usando host e porta do app.baseURL';

    public function run(array $params)
    {
        $config = config('App');
        $baseURL = $config->baseURL;

        $urlParts = parse_url($baseURL);
        // Pega o IP real da rede
        $host = $this->getLocalIp();
        $port = $urlParts['port'] ?? 8080;

        $cmd = PHP_BINARY . " " . escapeshellarg(ROOTPATH . 'spark') . " serve --host $host --port $port";
        CLI::write("Executando: $cmd", 'green');
        passthru($cmd);
    }

    protected function getLocalIp(): string
    {
        // Tenta pelo hostname da máquina
        $ip = gethostbyname(gethostname());

        // Se retornar 127.x ou ::1, tenta outra abordagem
        if (filter_var($ip, FILTER_VALIDATE_IP) && $ip !== '127.0.0.1') {
            return $ip;
        }

        // Método alternativo: abre socket para pegar IP local
        $socket = @socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
        if ($socket) {
            // Qualquer IP público serve para descobrir o local
            @socket_connect($socket, '8.8.8.8', 53);
            @socket_getsockname($socket, $localIp);
            @socket_close($socket);
            if (!empty($localIp)) {
                return $localIp;
            }
        }

        // fallback
        return '127.0.0.1';
    }
}
