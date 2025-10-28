export const ClientsTranslates = {
  invalid: {
    not_found: "O cliente selecionado não existe ou encontra-se inválida",
    name: "O nome do cliente encontra-se em uso ou inválido",
    status: "O status encontra-se vazio ou inválido",
    avatar: "A foto enviada encontra-se inválida ou inexistente",
    phone: "O numero de celular fornecido encontra-se inválido ou inexistente",
    email: "O e-mail encontra-se inválido",
    birthdate: "A data de nascimento encontra-se inválida",
    document: "O documento encontra-se inválido",
    document_type: "O tipo do documento encontra-se inválido",
    category: "A categoria encontra-se inválida ou inexistente",
    not_found_category:
      "A categoria encontra-se inativa ou inválida para ser vinculada",
    problems_create:
      "Ocorreu um problema nos nossos sistemas ao criar o cliente, tente novamente mais tarde.",
  },
  success: {
    post: "O cliente foi criado com sucesso",
    put: "O cliente foi atualizada com sucesso",
    patch: {
      photo: "A foto do cliente foi atualizada com sucesso",
    },
    delete: "O cliente foi movido para a lixeira com sucesso",
  },
  trash: {
    success: {
      restore: "Cliente(s) recuperado(s) com sucesso!",
      delete: "O cliente foi excluída permanentemente com sucesso!",
    },
  },
};
