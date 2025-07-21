import { timeFilter } from "../../Filters/time.js";

export function time(tRows, timer, colsRef) {
  return tRows.filter((tr) => {
    const tdList = tr.querySelectorAll("td");
    let isNotAccept = true;
  
    if (tdList.length == 0) return !isNotAccept;

    if (!Array.isArray(colsRef)) colsRef = [colsRef];

    for (const colRef of colsRef) {
      const col = tdList[colRef];

      if (!col) return !isNotAccept;

      const text = col.innerText.toLowerCase().split("/");

      if (timer.index == "start")
        isNotAccept = timeFilter(
          `${text[2]}-${text[1]}-${text[0]}`,
          timer.value,
          ">"
        );
      else
        isNotAccept = timeFilter(
          `${text[2]}-${text[1]}-${text[0]}`,
          timer.value,
          "<"
        );
      if (isNotAccept) tr.remove();
      return !isNotAccept;
    }
  });
}
