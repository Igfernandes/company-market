<?php
// check-psr4.php
// Rode: php check-psr4.php

$root = realpath(__DIR__);
$appDir = $root . DIRECTORY_SEPARATOR . 'app';

$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($appDir));
foreach ($it as $file) {
    if (!$file->isFile()) continue;
    if ($file->getExtension() !== 'php') continue;

    $content = file_get_contents($file->getPathname());
    if (preg_match('/namespace\s+([A-Za-z0-9_\\\\]+)\s*;/m', $content, $m)) {
        $ns = trim($m[1], '\\');
        $relative = preg_replace('#^App\\\\#', '', $ns);
        $expected = $appDir . ($relative !== '' ? DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $relative) : '');
        $actualDir = $file->getPath();

        // normaliza
        $expectedNorm = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $expected);
        $actualNorm = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $actualDir);

        if ($expectedNorm !== $actualNorm) {
            echo "❌ {$file->getPathname()}\n";
            echo "   Namespace: $ns\n";
            echo "   Esperado:  $expectedNorm\n";
            echo "   Atual:     $actualNorm\n\n";
        }
    }
}
