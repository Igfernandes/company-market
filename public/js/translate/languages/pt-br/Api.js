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
    },
    invalid: {
      name: "O nome encontra-se inferior a 3 caracteres ou inválido",
      document: "O documento encontra-se vazio ou inválido",
    },
  },
};
