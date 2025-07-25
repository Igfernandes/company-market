<?php

namespace App\Services\Mailer;

class OptionsMail
{
    public string $title;
    /** @property array{email:string,name:string} */
    public array  $recipients;
    public string $html;
    public string $textHtml;
}
