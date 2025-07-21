import { Table } from "./table.js";
import { locations } from "./locations.js";
import { createFilters } from "../../../../libs/Table/filters/createFilters.js";

export const init = async () => {
  const table = new Table();
  const { filters, filtersContent, table: tableElement } = locations;

  if (!tableElement || !filters) return;

  const { tableFilter } = filters.dataset;
  const filtersElements = await createFilters(
    tableFilter,
    tableElement,
    filtersContent
  );

  table.initial(filtersElements);
};
