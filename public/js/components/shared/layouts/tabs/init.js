export const init = () => {
  const container = document.querySelector("[component='tabs']");
  const containerTabs = container.querySelector("[component='tabs:header']");
  const tabs = Array.from(containerTabs.children);

  const handleUnableTabs = (tabSelectedIndex) => {
    tabs.forEach((tabRef) => {
      const tabIndex = tabRef.getAttribute("tab");

      if (
        tabIndex !== tabSelectedIndex &&
        tabRef.classList.contains("active")
      ) {
        tabRef.classList.remove("active");

        const content = container.querySelector(`[tab-target='${tabIndex}']`);
        content.classList.remove("active");
      }
    });
  };

  tabs.forEach((tab) =>
    tab.addEventListener("click", () => {
      const tabSelectedIndex = tab.getAttribute("tab");

      if (!tabSelectedIndex) return;

      const content = container.querySelector(
        `[tab-target='${tabSelectedIndex}']`
      );

      tab.classList.add("active");
      content.classList.add("active");

      handleUnableTabs(tabSelectedIndex);
    })
  );
};
