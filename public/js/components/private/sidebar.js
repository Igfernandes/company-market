export const init = () => {
  const sidebar = document.querySelector("[component='sidebar']");
  const toggleSidebarElements = document.querySelectorAll(
    "[component='sidebar:toggle']"
  );
  const toggleSidebarArr = Array.from(toggleSidebarElements);

  toggleSidebarArr.forEach((toggle) =>
    toggle.addEventListener("click", () => {
      const isSidebarHidden = sidebar.classList.contains("toggle");

      if (isSidebarHidden) sidebar.classList.remove("toggle");
      else sidebar.classList.add("toggle");
    })
  );
};
