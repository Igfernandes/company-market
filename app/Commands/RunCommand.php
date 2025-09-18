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
        $host = $urlParts['host'] ?? '0.0.0.0';
        $port = $urlParts['port'] ?? 8080;

        $cmd = PHP_BINARY . " " . escapeshellarg(ROOTPATH . 'spark') . " serve --host $host --port $port";
        CLI::write("Executando: $cmd", 'green');
        passthru($cmd);
    }
}
