import { Instance } from "../instance.js";
import { Pagination as PaginationComponent } from "../../../components/shared/content/table/pagination.js";
import { sliceArray } from "../../../helpers/sliceArray.js";

export function Pagination(
  { rows, table, pagePreview, pagination } = new Instance()
) {
  this.refresh = (currentMatriz) => {
    if (pagination && pagination.content) pagination.content.remove();

    return this.handle(currentMatriz);
  };

  this.handle = (currentMatriz) => {
    const matrizOfRows = sliceArray(rows, pagePreview);
    const { content, btns } = PaginationComponent({
      rows:
        String(parseInt(currentMatriz.length)) == "NaN"
          ? matrizOfRows
          : currentMatriz,
      pageIndex: pagination.currentIndex,
    });

    table.closest(".table-wapper").after(content);
    
    return {
      content,
      btns: btns.filter((btn) => !!btn),
    };
  };
}
