export function handleDeleteModal(ev) {
  const btn = ev.target;
  const modal = btn.closest("[component='modal']");
  
  modal.remove();
}
