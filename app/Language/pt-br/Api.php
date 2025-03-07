<?php

// override core en language system validation or define your own en language validation message
return [
    "authentications" => [
        "auth" => [
            "post" => [
                "credentials_invalid" => "As credenciais estão inválida",
                "success" => "A sua conta foi autenticada com sucesso em nossos sistemas"
            ]
        ],
        "remember" => [
            "post" => [
                "token_invalid" => "O usuário não está apto para essa operação.",
                "success" => "A sua conta foi autenticada com sucesso. Você será redirecionado."
            ]
        ]
    ],
    "tokens" => [
        "confirmEmail" => [
            "title" => "Confirme o seu e-mail",
            "emailAlreadyExists" => "O e-mail já está sendo utilizado no sistema. Por favor, utilize outro e-mail"
        ]
    ]
];
