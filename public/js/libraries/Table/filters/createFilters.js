import { SearchBar } from "../../../components/filters/SearchBar.js";
import { SelectFilter } from "../../../components/filters/Select.js";
import { TimeFilter } from "../../../components/filters/Time.js";
import { getDataAddress } from "../../../services/Data/get.js";

export async function createFilters(filters = "", table, filtersContent) {
  const filtersElements = {};
  const components = {
    search: new SearchBar(),
    time: new TimeFilter(),
    select: new SelectFilter(),
  };
  const filtersCurrent = filters.split("/");

  if (!filters) return;

  console.log(filters);
  let states = [];
  for await (const param of filtersCurrent) {
    if (param == "select") states = await getDataAddress();

    if (!components[param]) return;

    filtersElements[param] = components[param].create(filtersContent, {
      selects: {
        estados: await (states.data ?? []).map((state) => {
          return {
            label: state.Estado,
            value: state.UF,
          };
        }),
      },
      table,
    });
  }

  return filtersElements;
}
