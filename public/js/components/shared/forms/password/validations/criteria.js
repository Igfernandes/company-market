import {
  lowercaseRegex,
  numberRegex,
  symbolRegex,
  uppercaseRegex,
} from "../../../../../constants/regex.js";

const RULES_REGEX = {
  lowercase: lowercaseRegex,
  uppercase: uppercaseRegex,
  number: numberRegex,
  symbol: symbolRegex,
  min: /^.{8,}$/,
};

export const init = () => {
  const component = document.querySelector("[component='group-validation']");
  const input = component.querySelector(
    "[component='password:new-password'] input"
  );
  const groupValidation = new GroupValidations(component);

  const handleCriteria = (ev) => {
    const newPasswordValue = ev.currentTarget.value;

    groupValidation.execute(newPasswordValue);
  };

  input.addEventListener("change", handleCriteria);
  input.addEventListener("keyup", handleCriteria);
};

export function GroupValidations(container) {
  const criteria = container.querySelectorAll("[criterion]");
  const criteriaAttributeName = "criterion-status";

  this.execute = (value) => {
    Array.from(criteria).forEach((ruleElement) => {
      if (!value) return ruleElement.setAttribute(criteriaAttributeName, "");

      const rule = ruleElement.getAttribute("criterion");

      if (!rule || !RULES_REGEX[rule]) return;

      if (RULES_REGEX[rule].test(value)) {
        ruleElement.setAttribute(criteriaAttributeName, "APPROVED");
      } else {
        ruleElement.setAttribute(criteriaAttributeName, "INVALID");
      }
    });
  };

  this.hasAvailableCriterions = (value) => {
    let hasInvalidCriterion = false;

    Array.from(criteria).forEach((ruleElement) => {
      if (!value) return ruleElement.setAttribute(criteriaAttributeName, "");

      const rule = ruleElement.getAttribute("criterion");

      if (rule && !RULES_REGEX[rule]) return (hasInvalidCriterion = true);

      if (RULES_REGEX[rule].test(value)) return;

      hasInvalidCriterion = true;
    });

    return !hasInvalidCriterion;
  };
}
