const Mask = function () {
  let $url = "/js/libs/IntlTelInput";

  this.flag = function ($coord = ".js-input-flag") {
    if (document.querySelector($coord)) {
      let input = document.querySelectorAll($coord);
      for (let itens of input) {
        window.intlTelInput(itens, {
          utilsScript: $url + "/utils.js",
        });
      }
    }
  };

  this.mask = function ($obj = "00/00/0000", $coord = ".js-input-date") {
    if (document.querySelector($coord)) {
      jQuery($coord).mask($obj);
    }
  };

  this.cel = function ($coord = ".js-mask-celular") {
    let $obj;
    if (document.querySelector($coord)) {
      let input = document.querySelectorAll($coord);
      for (let itens of input) {
        window.intlTelInput(itens, {
          customPlaceholder: function (
            selectedCountryPlaceholder,
            selectedCountryData
          ) {
            $obj = selectedCountryPlaceholder;
            $obj = $obj.replace(/1|2|3|4|5|6|7|8|9/gi, "0");
            jQuery($coord).mask($obj);
            return selectedCountryPlaceholder;
          },
          utilsScript: $url + "/utils.js",
          initialCountry: "br",
        });
      }
    }
  };
};

export const init = () => {
  const instance = new Mask();

  instance.flag(); //Exemplo de campo só com bandeiras(sem a mascara)
  instance.cel(); //Exemplo de campo com bandeiras e filtro de mascara
  instance.mask(); //Exemplo de campo com mascara de data
  instance.mask("00000-000", ".js-mask-cep"); //Exemplo de campo com mascara de CEP
  instance.mask("000.000.000-00", ".js-mask-cpf"); //Exemplo de campo com mascara de CPF
  instance.mask("00.000.000/0001-00", ".js-mask-cnpj"); //Exemplo de campo com mascara de CNPJ
  instance.mask("00.000.000-0", ".js-mask-rg"); //Exemplo de campo com mascara de RG
  instance.mask("00/00/0000", ".js-mask-date"); //Mascara de data
  instance.mask("0000", ".js-mask-ano"); //Mascara de data
  instance.mask("(00)00000-0000", ".js-mask-tel"); //Mascara de Telefone
  instance.mask("00h00m", ".js-mask-horario"); //Mascara de Horário
  instance.mask("000", ".js-mask-code"); //Mascara de Horário
  instance.mask("000", ".js-mask-mes"); //Mascara de mês
  instance.mask("0000", ".js-mask-ano"); //Mascara de mês
  instance.mask("00/0000", ".js-mask-validatecard"); //Mascara de Horário
};
