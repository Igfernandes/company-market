<?php

use App\Components\Private\Users\Roles\Content;
use App\Components\Private\Users\Roles\Modals\ModalDelete;
use App\Components\Private\Users\Roles\Modals\ModalUpdate;
use App\Components\Shared\Utils\Permissions\Permissions;

Content::render();

Permissions::render();
ModalDelete::render();
ModalUpdate::render();
