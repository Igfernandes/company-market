export const CompaniesTranslates = {
  invalid: {
    not_found: "A empresa selecionado não existe ou encontra-se inválida",
    name: "O nome da empresa encontra-se em uso ou inválido",
    status: "O status encontra-se vazio ou inválido",
    logotype: "O logotipo enviada encontra-se inválida ou inexistente",
    phone: "O numero de celular fornecido encontra-se inválido ou inexistente",
    email: "O e-mail encontra-se inválido",
    inscribed_at: "A data de inauguração encontra-se inválida",
    document: "O documento encontra-se inválido",
    document_type: "O tipo do documento encontra-se inválido",
    problems_create:
      "Ocorreu um problema nos nossos sistemas ao criar o empresa, tente novamente mais tarde.",
  },
  success: {
    post: "A empresa foi criado com sucesso",
    put: "A empresa foi atualizada com sucesso",
    patch: {
      logotype: "A foto do empresa foi atualizada com sucesso",
    },
    delete: "A empresa foi movido para a lixeira com sucesso",
  },
  trash: {
    success: {
      restore: "empresa(s) recuperado(s) com sucesso!",
      delete: "A empresa foi excluída permanentemente com sucesso!",
    },
  },
};
