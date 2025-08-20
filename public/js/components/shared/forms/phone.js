export const init = () => {
  const components = Array.from(
    document.querySelectorAll("[component='phone']")
  );

  const handleMask = function (
    input,
    selectedCountryPlaceholder,
    intlTelInputData
  ) {
    let selectedMask = selectedCountryPlaceholder;
    const code = intlTelInputData.dialCode;

    selectedMask = selectedMask.replace(/1|2|3|4|5|6|7|8|9/gi, "0");

    if (input.getAttribute("mask") != selectedMask) {
      jQuery(input).mask(`+${code} ${selectedMask}`);
      input.setAttribute("mask", selectedMask);
    }
  };

  components.forEach((component) => {
    const phoneInput = component.querySelector("[component='phone:input']");
    const inputRef = document.querySelector("[component='phone:reference']");

    window.intlTelInput(inputRef, {
      customPlaceholder: (selectedCountryPlaceholder, intlTelInputData) => {
        handleMask(phoneInput, selectedCountryPlaceholder, intlTelInputData);
        return selectedCountryPlaceholder;
      },
      utilsScript: "/js/libraries/IntlTelInput/utils.js",
      initialCountry: component.getAttribute("code"),
    });
  });
};
