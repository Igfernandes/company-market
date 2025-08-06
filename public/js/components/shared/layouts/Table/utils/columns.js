export const isColumn = (name, meta, tableContainer) => {
  const tHds = tableContainer.querySelectorAll("thead th");
  const tHArr = Array.from(tHds).map((tH) => tH.textContent.toLowerCase());
  const index = tHArr.indexOf(name.toLowerCase());

  return meta.col === index;
};

export const getColumnIndex = (name, tableContainer) => {
  const tHds = tableContainer.querySelectorAll("thead th");
  const tHArr = Array.from(tHds).map((tH) => tH.textContent.toLowerCase());
  const index = tHArr.indexOf(name.toLowerCase());

  return index;
};
export const getTHdTexts = (tableContainer) => {
  const tHds = tableContainer.querySelectorAll("thead th");
  return Array.from(tHds).map((tH) => tH.textContent.toLowerCase());
};
