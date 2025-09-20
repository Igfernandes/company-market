import { handleReloadTable } from "./utils/handle.js";
import {
  getCheckedRows,
  getDeleteKey,
  getTable,
  getTableDeletes,
} from "./utils/target.js";

export const TableModules = {
  checkedRows: getCheckedRows,
  load: handleReloadTable,
  getTable,
  getDeletesBtn: getTableDeletes,
  getDeleteKey,
};
