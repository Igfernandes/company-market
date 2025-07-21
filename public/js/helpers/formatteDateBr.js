export function formatteDateBr(dateRef) {
  const date = new Date(dateRef);

  if (!dateRef) return "Indefinido";
  const day =
    date.getDate() < 10
      ? "0" + (date.getDate() == 0 ? 1 : date.getDate())
      : date.getDate();
  const month =
    date.getMonth() + 1 < 10
      ? "0" + (1 + date.getMonth())
      : 1 + date.getMonth();

  return `${day}/${month}/${date.getFullYear()}`;
}
