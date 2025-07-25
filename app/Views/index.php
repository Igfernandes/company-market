<?php

declare(strict_types=1);

use App\Components\Forms\Email\Email;

Component(new Email(
    name: "email",
    label: "Email",
    placeholder: "Digite seu email",
    className: null,
    required: "required",
    attributes: [],
    disabled: null,
    readonly: null
));
?>