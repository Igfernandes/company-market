<?php

namespace App\Services\Meta\Operations;

class SanitizerForMessenger
{
    public static function get(string $html)
    {
        // Substituir tags de quebra de linha por "\n"
        $html = preg_replace('/<\s*(br|p)\s*\/?>/i', "\n", $html);

        // Remover todas as demais tags HTML
        $plainText = strip_tags($html);

        // Decodificar entidades HTML (&nbsp;, &amp;, etc.)
        $plainText = html_entity_decode($plainText, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        // Remover múltiplos espaços e linhas consecutivas
        $plainText = preg_replace("/[ \t]+/", " ", $plainText);         // espaços duplos
        $plainText = preg_replace("/\n{2,}/", "\n\n", $plainText);      // múltiplas quebras de linha

        // Trim final
        return trim($plainText);
    }
}
