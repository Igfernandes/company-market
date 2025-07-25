export function select(tRows, value, colRef) {
  if (!value) return tRows;

  return tRows.filter((tr) => {
    const tdList = tr.querySelectorAll("td");

    if (tdList.length == 0) return false;

    const col = tdList[colRef];
    const text = col.innerText;

    if (!text.includes(value)) {
      tr.remove();
      return false;
    }

    return true;
  });
}
