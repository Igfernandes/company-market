<?php

declare(strict_types=1);

use App\Components\Public\Home\Clients\Clients;
use App\Components\Public\Home\Contact\Contact;
use App\Components\Public\Home\Faq\Faq;
use App\Components\Public\Home\Presentation\Presentation;
use App\Components\Public\Home\Services\Services;
use App\Components\Public\Home\Subscribe\Subscribe;

/**
 *  Template base para novos componentes
 *  Component: content
 *  Caminho: components/public/home/content
 */

?>

<div id="home" component="content">
    <?php
    Presentation::render();
    Services::render();
    Faq::render();
    Clients::render();
    Subscribe::render();
    Contact::render();
    ?>
</div>