import { ModalsModule } from "../exports.js";

export function isLoading(
  modalKey = "",
  { btnSide = "right", loading = false }
) {
  let btn = null;

  switch (btnSide) {
    case "right":
      btn = ModalsModule.getRightButton(modalKey);
      break;
    case "left":
      btn = ModalsModule.getLeftButton(modalKey);
      break;
  }

  if (!btn) return;

  if (loading) {
    btn.classList.add("submit");
    btn.setAttribute("disabled", true);
    return;
  } else {
    btn.removeAttribute("disabled");
  }
}
