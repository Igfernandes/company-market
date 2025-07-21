import { Ajax } from "./_ajax.js";

const Credentials = function () {
  this.validateSubmit = function () {
    let $form = document.querySelector(".credenciais form");
    document.querySelector("[name='new_token']") ? this.NewToken() : false;
    const vld = new Ajax();
    const msg = document.querySelector(".response-msg");

    $form.onsubmit = async (evt) => {
      evt.preventDefault();
      let inputtoken = $form.querySelector("input[name='token']");
      let inputmail = $form.querySelector("input[name='email']");
      $form.querySelector("button[type='submit']").disabled = true;

      if (inputtoken && inputtoken.value != null) {
        let $response = await vld.token(inputtoken.value);
        document.querySelector(".form-content").innerHTML = $response;

        try {
          JSON.parse($response).Error;
          msg.classList.remove("d-none");
          msg.classList.add("text-danger");
          msg.innerHTML = "O e-mail não é válido";

          setTimeout(() => {
            msg.classList.add("d-none");
            msg.innerHTML =
              "Aguarde <span>30</span> segundos para reenviar o código.";
          }, 2000);
        } catch (err) {
          document.querySelector(".login-box-msg strong").innerHTML =
            "Atualize seus dados abaixo!";

          this.updateCredentials();
        }
      } else if (inputmail && inputmail.value != null) {
        let $response = await vld.recover(inputmail.value);
        try {
          JSON.parse($response).Error;
          msg.classList.remove("d-none");
          msg.classList.add("text-danger");
          msg.innerHTML = "O e-mail não é válido";

          setTimeout(() => {
            msg.classList.add("d-none");
          }, 2000);

          $form.querySelector("button[type='submit']").disabled = false;
        } catch ($err) {
          document.querySelector(".form-content").innerHTML = $response;

          this.validateSubmit();
        }
      }
    };
  };

  this.NewToken = () => {
    let btn = document.querySelector("button[name='new_token']");
    const vld = new Ajax();
    const form = btn.closest("form");

    btn.onclick = function () {
      btn.disabled = true;
      let input = form.querySelector("input[type='email']")
        ? form.querySelector("input[type='email']").value
        : null;

      let val = 60;
      setTimeout(function loop() {
        let response = document.querySelector(".response-msg");
        if (val > 0 && response) {
          setTimeout(loop, 1000);
          response.classList.remove("d-none");

          response.querySelector("span").innerText = val--;
        } else {
          btn.disabled = false;
          if (response != null) {
            response.classList.add("d-none");
          }
        }
      }, 10);

      if (input && input.value) {
        vld.token(input.value);
      } else {
        vld.token(true);
      }
    };
  };

  this.updateCredentials = () => {
    let form = document.querySelector("[name='update-credentials']");
    const ajax = new Ajax();

    form.onsubmit = async function (evt) {
      evt.preventDefault();

      let inputs = document.querySelectorAll("input");
      let span = document.querySelector(".error-msg");

      let data = {
        senha: document.querySelector("[name='senha']").value,
        confirmacao_senha: document.querySelector("[name='confirmacao_senha']")
          .value,
      };

      if (data.confirmacao_senha == data.senha) {
        let $resp = await ajax.credentails(form.action, data);

        span.classList.remove("d-none");

        if ($resp.indexOf("Informações atualizadas!") >= 0) {
          span.closest("form").classList.add("sucess");
          span.innerText = "Informações atualizadas!";

          window.location.href = "/acesso";
        } else {
          span.closest("form").classList.add("error");
          span.innerText = "Falha ao atualizar os dados.";

          setTimeout(() => {
            span.closest("form").classList.remove("error");
            span.classList.add("d-none");
          }, 2500);
        }
      } else {
        span.classList.remove("d-none");
        span.closest("form").classList.add("error");
        span.innerText = "As senhas não são iguais!";
        setTimeout(() => {
          span.closest("form").classList.remove("error");
          span.classList.add("d-none");
        }, 2500);
      }
    };
  };
};

export const init = () => {
  let $cmd = new Credentials();

  if (document.querySelector('form[action="none"]')) {
    $cmd.validateSubmit();
  }
};
