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
    "users" => [
        "success" => [
            "store" => "O convite já foi enviado ao usuário"
        ]
    ],
    "groups" => [
        "success" => [
            "post" => "O grupo foi criado com sucesso",
            "put" => "O grupo foi atualizado com sucesso"
        ],
    ],
    "tokens" => [
        "confirmEmail" => [
            "title" => "Confirme o seu e-mail",
            "emailAlreadyExists" => "O e-mail já está sendo utilizado no sistema. Por favor, utilize outro e-mail"
        ]
    ],
    "categories" => [
        "success" => [
            "post" => "As categorias foram criadas com sucesso"
        ],
        "alerts" => [
            "has_clients" => "As categorias '{categories}' contém clientes. Desvincule antes de continuar."
        ]
    ],
    "clients" => [
        "success" => [
            "post" => "O cliente foi criado com sucesso",
            "patchCategory" => "Agora a categoria da base de clientes selecionada é {name}",
            "delete" => "O cliente foi deletado com sucesso"
        ],
        "invalid" => [
            "phone" => "O telefone do cliente encontra-se em uso ou inválido.",
            "required_clients" => "É necessário informar pelo menos um cliente.",
            "category" => "A categoria selecionada sofreu alterações ou está inválida. Recarregue e tente novamente."
        ]
    ]
];
