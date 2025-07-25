import { Cep } from "./Cep.js";
import { Cnpj } from "./Cnpj.js";
import { Cpf } from "./Cpf.js";
import { locations } from "./locations.js";

export const init = () => {
  const functions = {
    cpf: new Cpf(),
    cnpj: new Cnpj(),
    cep: new Cep(),
  };
  const { cpfFields, cnpjFields, cepFields } = locations;

  [...cpfFields, ...cnpjFields, ...cepFields].forEach((element) => {
    if (!element) return;

    Object.entries(element.dataset).forEach(([label, value]) => {
      if (functions[label])
        element.addEventListener("change", functions[label].handle);
    });
  });
};
