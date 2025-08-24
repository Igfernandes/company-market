import { setCache } from "./cache.js";

export async function fetchAndCacheData(ajax, chunkStart, limit, tableId, cache) {
  try {
    const response = await fetch(`${ajax}?start=${chunkStart}&limit=${limit}`);
    const total = response.headers.get("X-Total-Count");
    const result = await response.json();

    cache[chunkStart] = result;
    setCache(tableId, cache, total ?? result.length);
  } catch (err) {
    console.error("Erro ao carregar dados", err);
    throw err;
  }
}
