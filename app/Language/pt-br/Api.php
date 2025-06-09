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
    "invites" => [
        "success" => [
            "resend" => "O convite foi reenviado ao usuário",
        ]
    ],
    "users" => [
        "success" => [
            "store" => "O convite já foi enviado ao usuário",
            "delete" => "O usuário foi deletado com sucesso",
            "patch_status" => "O status do usuário foi atualizado com sucesso",
            "patch_password" => "A sua senha foi alterada com sucesso",
            "recover_password" => "O solicitação foi enviada com sucesso"
        ]
    ],
    "groups" => [
        "success" => [
            "post" => "O grupo foi criado com sucesso",
            "put" => "O grupo foi atualizado com sucesso",
            "delete" => "O grupo foi deletado com sucesso",
            "patch" => "O status do grupo foi atualizado com sucesso"
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
        "fields" => [
            "success" => [
                "post" => "O valor foi salvo com sucesso",
            ],
            "invalid" => [
                "client_id" => "O identificador do cliente é invalido"
            ]
        ],
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
    ],
    "fields" => [
        "success" => [
            "post" => "O campo foi criado com sucesso",
            "delete" => "O campo foi deletado com sucesso",
        ],
        "invalid" => [
            "id" => "O id do campo fornecido é invalido",
            "group" => "O grupo informado encontra-se inválido ou incorreto"
        ]
    ],
    "services" => [
        "success" => [
            "post" => "O serviço foi criado com sucesso.",
            "delete" => "O serviço foi deletado com sucesso"
        ],
        "invalid" => [
            "photo" => "A imagem encontra-se com problemas ou inválida. Reenvie ou tente uma outra imagem."
        ]
    ],
    "custom_forms" => [
        "post" => "O formulário foi criado com sucesso.",
        "fills" => [
            "delete" => "O registro foi deletado com sucesso"
        ]
    ],
    "integrations" => [
        "success" => [
            "post" => "Credenciais atualizadas com sucesso"
        ]
    ],
    "payment" => [
        "invalid" => [
            "not_found" => "O pagamento não existe no mercado ou encontra-se inválido. Refaça."
        ]
    ],
    "charges" => [
        "again_submit" => "Sua página continha recursos desatualizados, mas já resolvemos. Envie novamente o formulário",
        "invalid" => [
            "not_available" => "A cobrança já excedeu a quantidade disponível ou está expirada",
            "not_found_service_or_name" => "É obrigatório preencher o nome da cobrança ou selecionar um serviço"
        ],
        "success" => [
            "post" => "A sua cobrança foi criado com sucesso!",
            "delete" => "O cobrança foi deletado com sucesso"
        ]
    ]
];
