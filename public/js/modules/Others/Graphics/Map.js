import * as raphael from "/plugins/raphael/raphael.min.js";
import * as mapael from "/plugins/jquery-mapael/jquery.mapael.min.js";
import * as maps from "/plugins/jquery-mapael/maps/brazil.min.js";

export function GraphicMap() {
  this.execute = () => {
    $("#world-map-markers").mapael({
      map: {
        name: "brazil",
        zoom: {
          enabled: false,
          minLevel: 0,
          maxLevel: 5,
        },
      },
    });
  };
}
