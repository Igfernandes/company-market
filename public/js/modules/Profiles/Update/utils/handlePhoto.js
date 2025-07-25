import { Snackbar } from "../../../../components/snackbar/index.js";
import { postPhoto } from "../../../../services/Users/Photo/postPhoto.js";

export async function handlePhoto(ev) {
  const element = ev.currentTarget;
  const [file] = element.files;
  const snackbar = new Snackbar();

  if (!file) return false;

  const sizeFile = (file.size / (1024 * 1024)).toFixed(2);

  if (sizeFile > 2) {
    cleanFile(element);

    return snackbar.show(
      "failed",
      "A foto encontra-se com tamanho inválido e acima dos 2MB"
    );
  }

  if (!["image/jpeg", "image/jpg", "image/png"].includes(file.type)) {
    cleanFile(element);

    return snackbar.show(
      "failed",
      "A foto encontra-se com o formato inválido. Os permitidos são: JPGE, JPG e PNG"
    );
  }

  const formData = new FormData();
  formData.append("photo", file);

  const { data } = await postPhoto(formData);

  if (!data) return;

  snackbar.show("success", "A foto de perfil foi atualizada com sucesso!");
}

function cleanFile(file) {
  const groupUpload = file.closest(".form-upload");

  if (!groupUpload)
    return console.log(
      "Ocorreu um error ao encontrar a div de agrupamento de: " + file.name
    );

  file.value = null;

  const photoPreview = groupUpload.querySelector(
    "[data-target-preview='perfil']"
  );
  if (photoPreview) photoPreview.src = "/img/profile/perfil.jpg";
}
