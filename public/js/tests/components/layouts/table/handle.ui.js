import { Log } from "/js/tests/runtime/feedback.js";
import { hasAttributesInElement } from "/js/tests/runtime/validations/has.js";

export const HANDLE_TESTS = {
  ShouldSearchInTable: () => {
    const table = document.querySelector("[component='table']");
    const searchInput = table.querySelector("input[type='search']");

    if (!searchInput)
      return Log("ERROR", {
        component: "table",
        message: "O campo de busca não foi encontrado",
      });
    
    searchInput.value = "Test";
    searchInput.dispatchEvent(new Event('input'));

    if (table.querySelectorAll("tbody td.dt-empty").length === 0)
      return Log("ERROR", {
        component: "table",
        message: "A busca está retornando resultados inesperados",
      });

    return Log("SUCCESS", {
      component: "table",
      message: "O teste busca foi realizada com sucesso",
    });
  },
  ShouldButtonChangePage: () => {
    const table = document.querySelector("[component='table']");
    const paginationButtonNext = table.querySelector(".dt-paging-button.next");
    const paginationButtonPrevious = table.querySelector(".dt-paging-button.previous");

    if (!paginationButtonNext || !paginationButtonPrevious)
      return Log("ERROR", {
        component: "table",
        message: "Os botões de paginação não foram encontrados",
      });
    
    paginationButtonNext.click();
    if (!table.querySelector("tbody tr")) {
      return Log("ERROR", {
        component: "table",
        message: "A mudança de página não foi realizada corretamente",
      });
    }

    return Log("SUCCESS", {
      component: "table",
      message: "A mudança de página foi realizada com sucesso",
    });
  },
  ShouldOrderInTable: () => {
    const table = document.querySelector("[component='table']");
    const orderCells = table.querySelector("span.dt-column-title");

    if (!orderCells)
      return Log("ERROR", {
        component: "table",
        message: "As células de ordenação não foram encontradas",
      });

    orderCells.click();
    if (!table.querySelector("tbody tr")) {
      return Log("ERROR", {
        component: "table",
        message: "A ordenação não foi realizada corretamente",
      });
    }

    Log("SUCCESS", {
      component: "table",
      message: `A ordenação foi feita com sucesso`,
    });
  },
};
