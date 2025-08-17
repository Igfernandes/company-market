<?php

use CodeIgniter\Boot;
use Config\Paths;

/*
 *---------------------------------------------------------------
 * CHECK PHP VERSION
 *---------------------------------------------------------------
 */
$minPhpVersion = '8.1';
if (version_compare(PHP_VERSION, $minPhpVersion, '<')) {
    header('HTTP/1.1 503 Service Unavailable.', true, 503);
    echo sprintf(
        'Your PHP version must be %s or higher. Current version: %s',
        $minPhpVersion,
        PHP_VERSION
    );
    exit(1);
}

/*
 *---------------------------------------------------------------
 * SET THE CURRENT DIRECTORY
 *---------------------------------------------------------------
 */
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

if (getcwd() . DIRECTORY_SEPARATOR !== FCPATH) {
    chdir(FCPATH);
}

/*
 *---------------------------------------------------------------
 * LOAD PATHS CONFIG
 *---------------------------------------------------------------
 */
// Ajuste o caminho conforme sua estrutura de pastas
require __DIR__ . '/../app/Config/Paths.php';

$paths = new \Config\Paths(); // instanciando a classe Paths

/*
 *---------------------------------------------------------------
 * BOOTSTRAP THE FRAMEWORK
 *---------------------------------------------------------------
 */
require $paths->systemDirectory . '/Boot.php';

// Inicializa o CodeIgniter sem dar exit
Boot::bootWeb($paths);
