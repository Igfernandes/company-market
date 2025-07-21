export function tradingPage(ev, matriz, currentIndex) {
  const btn = ev.currentTarget;
  const index = parseInt(btn.dataset.paginationBtn) - 1;
  const text = btn.innerText;
  let newIndex;

  switch (text) {
    case "...":
      return index;
    case "Prev":
      newIndex = parseInt(currentIndex) - 1;
      return newIndex >= 0 ? newIndex : 0;
    case "Next":
      newIndex = parseInt(currentIndex) + 1;
      return newIndex < matriz.length ? newIndex : matriz.length - 1;
    default:
      return index;
  }
}
