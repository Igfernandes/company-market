export function tableAjax(tableContainer) {
  const { ajax } = tableContainer.dataset;
  if (!ajax) return {};

  const table = tableContainer.querySelector("table");

  const tableId = table.getAttribute("id");
  const registerPerSolicitation = 50;

  // Inicializa cache vazio
  localStorage.setItem(`data_${tableId}`, JSON.stringify({}));
  localStorage.setItem(`total_${tableId}`, 0);

  const getData = async function (settings, callback) {
    const cache = JSON.parse(localStorage.getItem(`data_${tableId}`)) || {};

    const pageStart = settings.start ?? 0;
    const chunkStart =
      Math.floor(pageStart / registerPerSolicitation) * registerPerSolicitation;

    // Se o chunk ainda não está no cache
    if (!cache[chunkStart]) {
      try {
        const response = await fetch(
          `${ajax}?start=${chunkStart}&limit=${registerPerSolicitation}`
        );

        const total = response.headers.get("X-Total-Count");
        const result = await response.json();

        // Atualiza total e cache
        localStorage.setItem(`total_${tableId}`, total ?? result.length);
        cache[chunkStart] = result;
        localStorage.setItem(`data_${tableId}`, JSON.stringify(cache));
      } catch (err) {
        console.error("Erro ao carregar dados", err);
        return callback({ data: [], recordsTotal: 0, recordsFiltered: 0 });
      }
    }

    // Junta todos os chunks já carregados
    const savedData = JSON.parse(localStorage.getItem(`data_${tableId}`)) || {};
    const total = localStorage.getItem(`total_${tableId}`);

    const datas = Object.values(savedData).flat();

    // Recorta os dados da página atual
    const pageEnd = pageStart + total;
    const pageData = datas.slice(pageStart, pageEnd);

    const callbackProps = {
      data: pageData,
    };

    if (!table.querySelector("thead")) {
      const sample = pageData[0];
      const columns = Object.keys(sample).map((key) => ({
        data: key,
        title: key,
        name: key,
      }));
      callbackProps["columns"] = columns;
    } else {
      callbackProps["data"] = pageData.map((data) => Object.values(data));
    }

    callback(callbackProps);
  };

  return {
    processing: true,
    ajax: getData,
  };
}
