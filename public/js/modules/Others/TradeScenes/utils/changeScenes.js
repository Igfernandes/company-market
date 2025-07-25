import { locations } from "../locations.js";

export function changeScenes(targetScenes) {
  const { scenes } = locations;
  if (!targetScenes) throw new Error("Is necessary targetScene value.");

  const targetSceneElement = document.querySelector(
    `[data-scenes='${targetScenes}']`
  );

  if (!targetSceneElement) throw new Error("Is necessary targetScene value.");
  const form = targetSceneElement.closest("form");

  if (form) form.classList.add("was-validated");
  
  scenes.forEach((scene) => scene.classList.remove("active-scenes"));
  targetSceneElement.classList.add("active-scenes");
}
