<?php

if (!function_exists('deleteCacheWithPrefix')) {
    function deleteCacheWithPrefix($prefix)
    {
        $cacheDir = WRITEPATH . 'cache'; // Diretório de cache do CodeIgniter

        // Lista todos os arquivos no diretório de cache
        $files = scandir($cacheDir);

        // Filtra os arquivos com o prefixo fornecido
        foreach ($files as $file) {
            if (strpos($file, $prefix) === 0 && is_file($cacheDir . '/' . $file)) {
                unlink($cacheDir . '/' . $file); // Exclui o arquivo de cache com esse prefixo
            }
        }
    }
}
