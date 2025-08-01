import exceptions from "./exceptions.js";

export function isAvailableRule(ruleName) {
  if (ruleName == "exceptions" || ruleName == "ref") return;
}

export function availableRulesException(rules) {
  if (!Array.isArray(rules.exceptions)) return true;

  for (const [exceptionFunction, exceptionValues] of rules.exceptions) {
    const execExceptions = exceptions[exceptionFunction];

    if (!execExceptions)
      return console.log(
        `error_${ruleLabel}:Não foi possível encontrar a validação de ${name}`
      );

    if (!execExceptions(exceptionValues, field)) return;
  }
}
