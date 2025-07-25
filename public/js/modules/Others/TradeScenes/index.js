import { locations } from "./locations.js";
import { requiredFields } from "./utils/requiredFields.js";

export function TradeScenes() {
  this.handle = (ev) => {
    const btn = ev.currentTarget;
    const { scenes } = locations;
    const { targetScenes, backScenes } = btn.dataset;

    if (!targetScenes) throw new Error("Not found scene reference to trade.");

    const targetSceneElement = document.querySelector(
      `[data-scenes='${targetScenes}']`
    );

    if (!backScenes) {
      const currentScene = btn.closest("[data-scenes]");
      const { rulesScenes } = currentScene.dataset;

      if (rulesScenes && rulesScenes.includes("required-fields")) {
        const response = requiredFields(currentScene);

        if (!response) return;
      }

      btn.closest("form").classList.remove("was-validated");
    }

    scenes.forEach((scene) => scene.classList.remove("active-scenes"));
    targetSceneElement.classList.add("active-scenes");
  };
}
