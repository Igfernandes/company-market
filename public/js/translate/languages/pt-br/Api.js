export const API = {
  invalid: {
    recaptcha:
      "A página contém recursos desatualizados. Recarregue e tente novamente.",
  },
  auth: {
    success: {
      post: "Logo você será redirecionado",
    },
    invalid: {
      credentials: "As credenciais encontram-se inválidas",
      recaptcha:
        "A página contém recursos desatualizados. Recarregue e tente novamente.",
    },
  },
  recovers: {
    password: {
      invalid: {
        email: "O e-mail encontra-se não informado ou inválido",
        token:
          "A solicitação encontra-se inválida ou expirada. Recomece e tente novamente.",
      },
    },
  },
  exports: {
    success: {
      post: "A exportação foi concluída com sucesso",
    },
    invalid: {
      entity:
        "O sistema ainda não tem integrado a exportação desse modelo de dados",
    },
  },
  invites: {
    success: {
      post: "O convite foi enviado com sucesso para o e-mail do novo usuário",
    },
    invalid: {
      already_exists_email: "O e-mail inserido encontra-se utilizado",
    },
  },
  users: {
    success: {
      recover_password: "Abra a sua caixa de e-mail e siga as instruções",
      put: "Informações do usuário atualizadas com sucesso",
      post: "O usuário foi criado com sucesso",
      delete: "O usuário foi excluído e enviado para lixeira",
      trash: {
        restore: "Usuário(s) recuperado(s) com sucesso!",
        delete: "O usuário foi excluído permanentemente com sucesso!",
      },
    },
    permissions: {
      success: {
        post: "As permissões do usuário foram atualizadas com sucesso",
      },
    },
    invalid: {
      password:
        "A senha encontra-se com o formato inválido ou não atendendo aos critérios mínimos",
      birthdate: "A data de nascimento encontra-se com formato inválido",
      already_exists_email:
        "O email já encontra-se sendo utilizado por outro usuário",
      name: "O nome encontra-se inferior a 3 caracteres ou inválido",
      not_found_invite: "O convite encontra-se inválido ou expirado",
      already_exists_document:
        "O document inserido já está sendo utilizado por outro usuário",
      document: "O documento encontra-se vazio ou inválido",
      not_found: "O usuário selecionado não existe ou encontra-se inválido",
    },
  },
  roles: {
    invalid: {
      not_permit:
        "A função escolhida pertence ao sistema e não pode ser excluída",
      not_found: "A função não pode ser encontrada ou está inválida",
      already_exists: "A função já está registrada no sistema",
      already_exists_name: "O nome da função já está sendo utilizado",
    },
    success: {
      post: "Função criada com sucesso",
      put: "Função atualizada com sucesso",
      delete: "Função excluída com sucesso",
    },
    permissions: {
      success: {
        post: "As permissões foram atualizadas com sucesso",
      },
    },
  },
  files: {
    success: {
      post: "Upload do arquivo completado",
    },
  },
};
