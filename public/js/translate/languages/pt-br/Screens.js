export const SCREENS = {
  default: {
    service_error:
      "Ocorreu um problema em nosso sistema. Tente a operação mais tarde.",
  },
  auth: {
    snackbar_title: "Autenticação",
  },
  forgot_password: {
    snackbar_title: "Recuperação de Senha",
    sending_form: "Enviando Solicitação",
    awaiting: "Aguarde enquanto estamos enviando a solicitação",
  },
  alter_password: {
    snackbar_title: "Alteração de Senha",
    sending_form: "Enviando Solicitação",
    awaiting: "Aguarde enquanto estamos enviando a solicitação",
  },
  users: {
    snackbar_title: "Atualização de informações",
    delete: {
      modal_title: "Confirmar Exclusão",
      modal_subtitle: "Você tem certeza que deseja excluir este usuário?",
      modal_text:
        "Após a exclusão, o usuário será movido para a Lixeira. Enquanto estiver lá, ele poderá ser recuperado a qualquer momento ou removido de forma definitiva.",
    },
    trash: {
      invalid: {
        user_ids:
          "É obrigatório selecionar pelo menos um usuário para a restauração",
      },
    },
  },
  invites: {
    snackbar_title: "Convite de Usuário",
  },
  exports: {
    snackbar_title: "Exportação de dados",
  },
  notifications: {
    snackbar_title: "Notificações",
  },
};
