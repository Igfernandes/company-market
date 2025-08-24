import { getDataInObject } from "./object.js";

export function mapData(data = [], orderKeys) {
  return data.map((item) => {
    if (Array.isArray(orderKeys) && orderKeys.length > 0) {
      const orderObjects = orderKeys.map((key) => {
        if (Object.is(item[key])) {
          return getDataInObject(key, key);
        } else return item[key];
      });

      return orderObjects;
    }
    return Object.values(item);
  });
}
