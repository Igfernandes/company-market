import { getDataInObject } from "../../../../../helpers/object.js";
import { capitalize } from "../../../../../helpers/string.js";
import { translate } from "../../../../../translate/index.js";

export function mapData(data = [], orderKeys) {
  return data.map((item) => {
    if (Array.isArray(orderKeys) && orderKeys.length > 0) {
      const orderObjects = orderKeys.map((key) => {
        let indexes = key.split(".");

        const firstKey = indexes[0];
        indexes = indexes.splice(1);

        let value = item[key] ?? "--";

        if (Array.isArray(item[firstKey]) && item[firstKey].length > 0) {
          value = getDataInObject(indexes.join("."), item[firstKey][0]) ?? "--";
        } else if (
          typeof value === "string" &&
          dayjs(value.replace(" ", "T")).isValid()
        ) {
          value = dayjs(value.replace(" ", "T")).format("DD/MM/YYYY HH:mm");
        } else if (Object.is(value)) {
          value = getDataInObject(key, value) ?? "--";
        }

        const wordTranslate = translate(`Words.${String(value).toLowerCase()}`);

        if (wordTranslate) return capitalize(wordTranslate);
        else return value;
      });

      return orderObjects;
    }
    return Object.values(item);
  });
}
