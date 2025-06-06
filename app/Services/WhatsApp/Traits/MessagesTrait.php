<?php

namespace App\Services\WhatsApp\Traits;

trait MessagesTrait
{

    /**
     * Converte um conteúdo HTML em texto formatado para envio no WhatsApp.
     *
     * Este método interpreta tags HTML básicas e as transforma em uma
     * formatação compatível com a API do WhatsApp (ex: *negrito*, _itálico_),
     * removendo tags não suportadas e preservando quebras de linha.
     *
     * Tags suportadas:
     * - <strong>, <b> → *negrito*
     * - <em>, <i> → _itálico_
     * - <s>, <del> → ~tachado~
     * - <code> → `monoespaçado`
     * - <pre> → ```bloco de código```
     * - <br>, <p>, <div> → convertidos em quebras de linha
     *
     * @param string $html Conteúdo HTML de entrada.
     *
     * @return string Texto convertido e formatado para envio seguro via WhatsApp.
     */
    public function convertHtmlToWhatsAppText(string $html): string
    {
        $replacements = [
            '/<br\s*\/?>/i' => "\n",
            '/<\/?p[^>]*>/i' => "\n",
            '/<\/?div[^>]*>/i' => "\n",
            '/<strong>(.*?)<\/strong>/i' => '*$1*',
            '/<b>(.*?)<\/b>/i' => '*$1*',
            '/<em>(.*?)<\/em>/i' => '_$1_',
            '/<i>(.*?)<\/i>/i' => '_$1_',
            '/<u>(.*?)<\/u>/i' => '$1', // WhatsApp não suporta sublinhado
            '/<s>(.*?)<\/s>/i' => '~$1~',
            '/<del>(.*?)<\/del>/i' => '~$1~',
            '/<code>(.*?)<\/code>/i' => '`$1`',
            '/<pre[^>]*>(.*?)<\/pre>/is' => "```\n$1\n```",
        ];

        foreach ($replacements as $pattern => $replacement) {
            $html = preg_replace($pattern, $replacement, $html);
        }

        $text = strip_tags($html);
        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $text = preg_replace("/[ \t]+/", ' ', $text);
        $text = preg_replace("/\n{2,}/", "\n\n", $text);
        $text = trim($text);

        return $text;
    }
}
