import { Instance } from "../instance.js";
import { time as timeFilter } from "../filters/time.js";
import { searchbar } from "../filters/searchbar.js";
import { select as selectFilter } from "../filters/select.js";
import { Pagination } from "./pagination.js";
import { sliceArray } from "../../../helpers/sliceArray.js";
import { tradingPage } from "../utils/tradePage.js";

export function Reload(instance = new Instance()) {
  this.instance = instance;

  this.handle = () => {
    const {
      table,
      rows,
      pagePreview,
      filters: { time, select, search } = {},
      filtersRef: { timeRef, selectRef } = {},
    } = this.instance;
    const { currentIndex } = this.instance.pagination;
    const pagination = new Pagination(this.instance);
    let currentRows = rows;
    const tbody = table.querySelector("tbody");
    tbody.innerHTML = "";

    Object.entries(time ?? {}).forEach(
      ([index, element]) =>
        (currentRows = timeFilter(
          currentRows,
          {
            value: element.value,
            index: index,
          },
          timeRef
        ))
    );
 
    Object.keys(select ?? {}).forEach(
      (index) =>
        (currentRows = selectFilter(
          currentRows,
          select[index].value,
          selectRef[index]
        ))
    );

    currentRows = searchbar(currentRows, search);
 
    const matrizOfRows = sliceArray(currentRows, pagePreview);
    (matrizOfRows[currentIndex ?? 0] ?? []).forEach((row) =>
      table.querySelector("tbody").appendChild(row)
    );
 
    this.instance.pagination = pagination.refresh(matrizOfRows, currentIndex);

    const btns = this.instance.pagination.btns;

    btns.forEach((btn) => {
      btn.addEventListener("click", (ev) => {
        this.instance.pagination["currentIndex"] = tradingPage(ev, matrizOfRows, currentIndex);
        this.handle();
      });
    });
  };
}
