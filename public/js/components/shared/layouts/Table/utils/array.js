import { getDataInObject } from "../../../../../helpers/object.js";
import { translate } from "../../../../../translate/index.js";

export function mapData(data = [], orderKeys) {
  return data.map((item) => {
    if (Array.isArray(orderKeys) && orderKeys.length > 0) {
      const orderObjects = orderKeys.map((key) => {
        let indexes = key.split(".");
        const firstKey = indexes[0];
        indexes = indexes.splice(1);
        let value = "--";

        if (Array.isArray(item[firstKey]) && item[firstKey].length > 0) {
          value = getDataInObject(indexes.join("."), item[firstKey][0]) ?? "--";
        } else if (Object.is(item[key])) {
          value = getDataInObject(key, item[key]) ?? "vazio";
        } else value = item[key] ?? "vazio";

        return translate(`Words.${String(value).toLowerCase()}`) ?? value;
      });

      return orderObjects;
    }
    return Object.values(item);
  });
}
