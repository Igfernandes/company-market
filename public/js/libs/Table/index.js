import { Reload } from "./handles/reload.js";
import { Instance } from "./instance.js";

export function Table(props) {
  this.instance = new Instance(props);

  this.handle = () => {
    const {
      filters: { select, search, time },
    } = this.instance;
    const reload = new Reload(this.instance);

    reload.handle();

    Object.entries(search).forEach(([index, filters]) => {
      filters.addEventListener("keyup", reload.handle);
    });

    Object.entries({ ...time, ...search }).forEach(([index, filters]) => {
      filters.addEventListener("change", reload.handle);
    });

    Object.entries(search).forEach(([index, filters]) => {
      filters.addEventListener("click", reload.handle);
    });

    Object.entries(select ?? {}).forEach(([index, selectElement]) =>
      $(selectElement).on("select2:select", reload.handle)
    );
  };
}
