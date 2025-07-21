export function Instance({
  table,
  rows,
  filters,
  filtersRef,
  pagePreview = 8,
} = {}) {
  this.table = table;
  this.rows = rows;
  this.filters = filters;
  this.filtersRef = filtersRef;
  this.pagePreview = pagePreview;
  this.pagination = {
    currentIndex: 0,
    content: null,
    btns: null,
  };
}
