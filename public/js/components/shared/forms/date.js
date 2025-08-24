import { isDayValid, isMonthValid } from "../../../helpers/date.js";
import { translate } from "../../../translate/index.js";
import { snackbar } from "../utils/snackbar.js";

const maskDates = {
  default: "YYYY-MM-DD",
  br: "DD/MM/YYYY",
};

export const init = () => {
  const components = Array.from(
    document.querySelectorAll("[component='date-icon']")
  );

  const handleDate = function (ev, dateRef) {
    const input = ev.currentTarget;
    const value = input.value;

    const country = input.getAttribute("country");
    const isDateBrazilian = value.split("/").length == 3;

    const numbers = value.replace(/\D/g, "");
    const datesPart = value.split("/");
    const isDateValid = isMonthValid(datesPart[1]) && isDayValid(datesPart[0]);

    if (numbers.length > 4 && !isDateValid) {
      const text = input.dataset.label ?? input.name;
      snackbar.execute("NOTICE", {
        message: `${text} ${translate(
          "Texts.invalid_date"
        ).toLocaleLowerCase()}`,
      });

      return (input.value = "");
    }

    if (!isDateBrazilian || country === "br") jQuery(input).mask("00/00/0000");
    else {
      jQuery(input).mask("00/00/0000");
    }

    if (numbers.length == 8) {
      const date =
        country === "br" ? value.split("/").reverse().join("-") : value;
      dateRef.value = date;
    }
  };

  const handleDateRef = function (ev, date) {
    const dateRef = ev.currentTarget;
    const country = date.getAttribute("country");
    const mask = maskDates[country ?? "default"];

    date.value = dayjs(dateRef.value).format(mask);
  };

  components.forEach((component) => {
    const dateInput = component.querySelector("[component='date-icon:input']");
    const dateRef = document.querySelector("[component='date-icon:reference']");

    dateInput.addEventListener("keyup", (ev) => handleDate(ev, dateRef));
    dateRef.addEventListener("change", (ev) => handleDateRef(ev, dateInput));
  });
};
