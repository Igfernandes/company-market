<?php

use App\Components\Private\Clients\Form\Content;
use App\Database\Entities\Clients\ClientEntity;

Content::render(
    client: $client ?? new ClientEntity(),
    categories: $categories ?? []
);
