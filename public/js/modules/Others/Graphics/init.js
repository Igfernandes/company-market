import { GraphicCircle } from "./Circle.js";
import { GraphicMap } from "./Map.js";

export const init = () => {
  const graphicCircle = new GraphicCircle();
  const graphicMap = new GraphicMap();

  graphicCircle.execute();
  graphicMap.execute();
};
