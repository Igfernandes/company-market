import { Log } from "/js/tests/runtime/feedback.js";

export const INIT_TESTS = {
  ShouldCreateGroupValidation: () => {
    const passwordGroup = document.querySelector("[component='group-validation']");
    const elementName = "group-validation";

    if (!passwordGroup)
      return Log("ERROR", {
        component: elementName,
        message: `O ${elementName} não foi encontrado`,
      });

    Log("SUCCESS", {
      component: elementName,
      message: `O ${elementName} foi criado com sucesso`,
    });
  },
  ShouldExistsCriteriaInGroupValidation: () => {
    const passwordGroup = document.querySelector("[component='group-validation']");
    let hasError = false;
    const elementName = "group-validation";

    ['lowercase',
    'uppercase',
    'number',
    'symbol',
    'min'].forEach((param) => {
      const hasElementInPassword = passwordGroup.querySelector(
        `[criterion="${param}"]`
      );
      if (!hasElementInPassword) {
        Log("ERROR", {
          component: elementName,
          message: `O critério ${param} do ${elementName} não pode ser encontrado`,
        });
        hasError = true;
      }
    });

    if (hasError) return;

    Log("SUCCESS", {
      component: elementName,
      message: `O ${elementName} foi criado com sucesso`,
    });
  },
  ShouldExistsInputInGroupValidation : () => {
    const passwordGroup = document.querySelector("[component='group-validation']");
    let hasError = false;

    ['new-password', 'confirmation'].forEach((input) => {
      if (!passwordGroup.querySelector(`[component="password:${input}"]`)) {
        Log("ERROR", {
          component: "group-validation",
          message: `O campo ${input} não foi encontrado`,
        });
        hasError = true;
      }
    });

    if (hasError) return;

    Log("SUCCESS", {
      component: "group-validation",
      message: "Os campos de senha e confirmação foram encontrados com sucesso",
    });
  }
};
