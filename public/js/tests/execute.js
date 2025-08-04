import { checkLoadComponents, loadComponent } from "./libraries/component.js";
import {
  handleComponentTests,
  handleSearchComponentsByName,
} from "./libraries/handle.js";

(async function () {
  await checkLoadComponents();

  document
    .querySelectorAll("[data-component='action']")
    .forEach((btn) => btn.addEventListener("click", handleComponentTests));

  const url = new URL(window.location.href);

  document.querySelectorAll("[data-navbar='component']").forEach((item) =>
    item.addEventListener("click", (ev) => {
      const { component } = ev.currentTarget.dataset ?? {};
      document
        .querySelectorAll("[data-navbar='component']")
        .forEach((navbar) => navbar.classList.remove("is_active"));

      loadComponent(component);
    })
  );

  document
    .querySelector("[data-component='restore']")
    .addEventListener("click", () => {
      const url = new URL(window.location.href);
      const component = url.searchParams.get("component");
      
      if (component) loadComponent(component);
    });
  document
    .querySelector("[data-search='component']")
    .addEventListener("keydown", handleSearchComponentsByName);

  const component = url.searchParams.get("component");
  if (component) loadComponent(component);
})();
