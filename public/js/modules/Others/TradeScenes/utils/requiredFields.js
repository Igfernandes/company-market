export function requiredFields(scenes = document.querySelector("")) {
  const fields = scenes.querySelectorAll("[name]:invalid");
  const form = scenes.closest("form");

  for (const field of fields) {
    if (field.required == true && !field.value) {
      form.classList.add("was-validated");
      return false;
    }
  }

  return true;
}
