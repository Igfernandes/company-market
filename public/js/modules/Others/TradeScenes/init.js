import { TradeScenes } from "./index.js";
import { locations } from "./locations.js";

export const init = () => {
  const { buttons } = locations;
  const tradeScenes = new TradeScenes();

  buttons.forEach((btn) => btn.addEventListener("click", tradeScenes.handle));
};
