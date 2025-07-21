export function Accordion({ tabs = [], content }) {
  const accordion = document.createElement("div");
  accordion.className = "accordion content-ranking";
  accordion.id = "accordionRanking";

  tabs.forEach((tab) => accordion.appendChild(tab));

  content.appendChild(accordion);
  $(".collapse").collapse();

  return accordion;
}
