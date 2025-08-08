import { render } from "/js/tests/runtime/component.js";
import { Log } from "/js/tests/runtime/feedback.js";
import { inicializeForm } from "/js/components/shared/forms/forms.js";

export const HANDLE_TESTS = {
  ShouldEnableButtonWhenUseInicializeFormFunction: () => {
    const form = document.createElement("form");
    const submit = document.querySelector("[component='submit']");
    const btn = submit.querySelector("button");

    form.appendChild(submit);

    render(form);

    inicializeForm(form);

    if (btn.hasAttribute("disabled"))
      return Log("ERROR", {
        component: "submit",
        message: "O botão de submit não foi iniciado com sucesso",
      });

    return Log("SUCCESS", {
      component: "submit",
      message: "O botão de submit foi criado com sucesso",
    });
  },
};
