import { Arrow } from "../../../../assets/arrow.js";
import { tabHeadButtonAttributes } from "./constants.js";

export function Tab({
  header = {
    text,
  },
  accordionId,
  body,
}) {
  const tab = document.createElement("div");
  tab.className = "card content";

  const tabHeader = document.createElement("div");
  tabHeader.className = "card-header";

  const h2 = document.createElement("h2");
  h2.className = "mb-0 h-100";

  const tabHeadButton = document.createElement("button");
  tabHeadButton.className =
    "btn btn-link btn-block text-left d-flex h-100 justify-content-between align-items-center";
  tabHeadButton.setAttribute("data-target", `#collapse${accordionId}`);
  tabHeadButton.setAttribute("aria-controls", `collapse${accordionId}`);
  tabHeadButtonAttributes.forEach((attribute) =>
    tabHeadButton.setAttribute(attribute.label, attribute.value)
  );

  const tabHeadH4 = document.createElement("h4");
  tabHeadH4.textContent = header.text;
  const tabHeadIconContent = document.createElement("div");
  tabHeadIconContent.className = "icon-arrow d-flex";
  tabHeadIconContent.innerHTML = Arrow();

  tabHeadButton.appendChild(tabHeadH4);
  tabHeadButton.appendChild(tabHeadIconContent);
  h2.appendChild(tabHeadButton);
  tabHeader.appendChild(h2);

  const tabBody = document.createElement("div");
  tabBody.id = `collapse${accordionId}`;
  tabBody.className = "card-body collapse";
  tabBody.setAttribute("data-parent", "#accordionRanking");
  tabBody.setAttribute("aria-labelledby", accordionId);
  tabBody.appendChild(body);

  tab.appendChild(tabHeader);
  tab.appendChild(tabBody);
  return tab;
}
