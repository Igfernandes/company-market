export function searchbar(tRows, { select, input }) {
  const colIndex = select.value;
  const value = input.value.toLowerCase();

  return tRows.filter((tr) => {
    const tdList = tr.querySelectorAll("td");

    if (tdList.length == 0) return false;

    const colCurrent = !!colIndex ? [tdList[colIndex]] : tdList;

    for (const col of colCurrent) {
      const text = col.innerText.toLowerCase();

      if (text.includes(value) || !value) {
        return true;
      }

      tr.remove();
      return false;
    }
  });
}
