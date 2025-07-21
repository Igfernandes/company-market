export const errors = {
  required: "O campo é obrigatório",
  typeof:
    "A informação inserida não corresponde ao valor necessário, insira o correto",
  min: "O campo precisa ser preenchido com no mínimo ${min} caracteres",
  max: "O campo apenas permite o máximo de ${max} caracteres",
  length: "O campo deve conter ${length} caracteres",
  notFound:
    "Não foi possível encontrar um campo necessário no formulário. <br/> Entre em contato com a equipe técnica",
  notFoundField: "Não foi possível encontrar o campo ${field}",
  fileLimite: "O arquivo é maior do que ${limite}. Não é permetido!",
  notEquals: "O valor do campo ${reference} precisa ser igual ao ${field}",
  dateMax: "A data inserida precisa ser inferior a ${data}",
  dateMin: "A data inserida precisa ser superior a ${data}",
  noEmpty: "O campo não pode ficar vazio",
  notFoundForm:
    "{validations}: Não foi possível encontrar o formulário pelo identificador informado",
  notValidDate: "A data inserida não é válida.",
  notValidPassword: "A senha precisa ter ${validPassword}.",
  notValidEmail:
    "O email digitado não é um email valido. Por favor insira conforme o exemplo: email@email.com ",
  notValidThelephone:
    "O telefone digitado não contem um numero valido. Por favor insira conforme o exemplo: (xx) xxxxx-xxxx ",
  notValidUrl: "O endereço de ${reference} adicionado não é valido",
  notRelationFields:
    "O campo <strong>${reference}</strong> é obrigatório e precisa ser preenchido.",
  notSomeRequiredFields: "Um dos campos abaixo precisa ser preenchido",
  regex: "O valor de ${field} é invalido ou não atende aos critérios mínimos",
  match: "O ${field} não corresponde um valor válido",
  hasField: "O ${field} inserido já está sendo utilizado em nosso sistema"
};
