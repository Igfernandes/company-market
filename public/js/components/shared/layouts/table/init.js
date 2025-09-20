import "/js/libraries/DataTables/dataTables.js";
import "/js/libraries/DataTables/dataTables.responsive.js";
import "/js/libraries/DataTables/responsive.dataTables.js";

import { handleCheckedAll } from "./utils/handle.js";
import './utils/globals.js'
import { tableInstance } from "./settings/instance.js";

export const init = () => {
  const tableContainers = document.querySelectorAll("[component='table']");

  tableContainers.forEach((tableContainer) => {
   tableInstance(tableContainer);
  });
  handleCheckedAll();
};
