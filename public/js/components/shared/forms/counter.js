export const init = () => {
  const counters = document.querySelectorAll("[component='counter-field']");

  counters.forEach(function (counter) {
    const counterValue = counter.querySelector(
      "[component='counter-field:value']"
    );
    const inputSelector = counter.getAttribute("counter-field");
    const input = document.querySelector(`[name='${inputSelector}']`);
    const counterRef = counter.querySelector("[component='counter-field:ref']");

    input.addEventListener("keyup", function (event) {
      const value = event.currentTarget.value;
      const maxValue = +(counterRef.textContent ?? 0);
      const currentValue = value.length;

      if (currentValue <= maxValue)
        return (counterValue.textContent = currentValue);

      counterValue.textContent = currentValue - maxValue;
    });
  });
};
