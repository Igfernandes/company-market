// Inicializa cache vazio
export function initCache(tableId) {
  localStorage.setItem(`data_${tableId}`, JSON.stringify({}));
  localStorage.setItem(`total_${tableId}`, 0);
}

export function getCache(tableId) {
  return JSON.parse(localStorage.getItem(`data_${tableId}`)) || {};
}

export function setCache(tableId, cache, total) {
  localStorage.setItem(`data_${tableId}`, JSON.stringify(cache));
  localStorage.setItem(`total_${tableId}`, total);
}
export function getAllCachedData(tableId) {
  const savedData = getCache(tableId);
  const total = parseInt(localStorage.getItem(`total_${tableId}`), 10) || 0;
  const datas = Object.values(savedData).flat();
  return { datas, total };
}
