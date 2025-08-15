export const init = () => {
  const settings = document.querySelector("[component='settings']");
  const boardTabsOptions = Array.from(
    settings.querySelectorAll("[component='settings:tab-option']")
  );

  const handleTabs = (ev) => {
    const tabOptionTarget = ev.target;
    const option = tabOptionTarget.getAttribute("tab-index");
    const contents = settings.querySelectorAll(`[tab-target]`);

    boardTabsOptions.forEach((option) => option.classList.remove("active"));
    tabOptionTarget.classList.add("active");

    Array.from(contents).forEach((tab) => {
      const tabIndex = tab.getAttribute("tab-target");

      if (tabIndex === option) tab.classList.add("active");
      else tab.classList.remove("active");
    });
  };

  Array.from(boardTabsOptions).forEach((tab) => {
    tab.addEventListener("click", handleTabs);
  });
};
