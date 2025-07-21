export function Select({
  name = "",
  value = "",
  options = [],
  className = "",
  events = {},
}) {
  const select = document.createElement("select");
  select.name = name;
  select.className = className;
  select.value = value;

  options.forEach(({ value: valueOption, label: labelOption }) => {
    const option = document.createElement("option");
    option.value = valueOption;
    option.textContent = labelOption;
    option.selected = valueOption == value;

    select.appendChild(option);
  });

  Object.entries(events).forEach(([event, callback]) => {
    select.addEventListener(event, callback);
  });

  return select;
}
