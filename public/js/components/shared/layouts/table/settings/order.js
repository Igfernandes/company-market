export function tableOrder(settings, data) {
  if (!settings.order || settings.order.length == 0) return data;

  const order = settings.order[0];
  if (!settings.columns[order.column]) return data;
  const columnName = settings.columns[order.column].settings;
  data.sort((a, b) => {
    const x = a[columnName];
    const y = b[columnName];
    if (x < y) return order.dir === "asc" ? -1 : 1;
    if (x > y) return order.dir === "asc" ? 1 : -1;
    return 0;
  });

  return data;
}
