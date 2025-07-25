import { Button } from "../../forms/button.js";

export function Pagination({ rows, pageIndex } = {}) {
  const content = document.createElement("div");
  content.className = "pagination";
  content.setAttribute("data-pagination-group", "true");
  const MAX_BTN_PREVIEW = 3;

  const groupPrev = document.createElement("div");
  const btnPrev = Button({
    text: "Prev",
    type: "button",
    className: "group-prev",
  });
  groupPrev.appendChild(btnPrev);

  const groupNext = document.createElement("div");
  const btnNext = Button({
    text: "Next",
    type: "button",
    className: "group-next",
  });

  groupNext.appendChild(btnNext);
  content.appendChild(groupPrev);

  const btns = [];
  const rowsLength = rows.length == 0 ? 1 : rows.length;
  const startIndex = pageIndex && pageIndex != 1 ? pageIndex : 1;

  let QUANTITY_LOOPS = 1;
  for (let x = startIndex; x <= rowsLength; x++) {
    const groupBtnPage = document.createElement("div");
    groupBtnPage.className = "group-index";
    btns[x] = Button({
      text: x,
      type: "button",
      className: pageIndex == (x - 1) || (!pageIndex && x == 1) ? 'active' : ''
    });
    btns[x].setAttribute("data-pagination-btn", x);
 
    groupBtnPage.appendChild(btns[x]);

    if (QUANTITY_LOOPS > MAX_BTN_PREVIEW) {
      btns[x].textContent = "...";
      btns[x].setAttribute("data-page-more", "true");
      content.appendChild(groupBtnPage);
      break;
    }

    content.appendChild(groupBtnPage);
    QUANTITY_LOOPS++;
  }

  content.appendChild(groupNext);

  return {
    content,
    btns: [...btns, btnNext, btnPrev],
  };
}
