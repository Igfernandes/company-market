import { getAllCachedData, getCache, initCache } from "../utils/cache.js";
import { buildCallbackProps } from "../utils/data.js";
import { fetchAndCacheData } from "../utils/fetch.js";

export function tableAjax(tableContainer) {
  const { ajax } = tableContainer.dataset;
  if (!ajax) return {};

  const table = tableContainer.querySelector("table");
  const tableId = table.getAttribute("id");
  const registerPerSolicitation = 50;

  // Inicializa cache
  initCache(tableId);

  const getData = async (settings, callback) => {
    const pageStart = settings.start ?? 0;
    const chunkStart = getChunkStart(pageStart, registerPerSolicitation);

    const cache = getCache(tableId);

    if (!cache[chunkStart]) {
      await fetchAndCacheData(
        ajax,
        chunkStart,
        registerPerSolicitation,
        tableId,
        cache
      );
    }

    const { datas, total } = getAllCachedData(tableId);

    const pageEnd = pageStart + total;
    const pageData = datas.slice(pageStart, pageEnd);

    const callbackProps = buildCallbackProps(table, pageData);

    callback(callbackProps);
  };

  return {
    processing: true,
    ajax: getData,
  };
}

function getChunkStart(pageStart, registerPerSolicitation) {
  return (
    Math.floor(pageStart / registerPerSolicitation) * registerPerSolicitation
  );
}
