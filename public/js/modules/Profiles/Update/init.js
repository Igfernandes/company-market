import { Validations } from "../../../libs/Validations/index.js";
import { UpdateProfileForm } from "./index.js";
import { locations } from "./locations.js";
import { rules } from "./rules/index.js";
import { handlePhoto } from "./utils/handlePhoto.js";

export const init = async () => {
  const updateProfileForm = new UpdateProfileForm();
  const { btnSubmit, form, photo } = locations;
  const validations = new Validations();

  await updateProfileForm.customForm();

  if (photo) photo.addEventListener("change", handlePhoto);

  if (!form) return;

  btnSubmit.addEventListener("click", updateProfileForm.handle);
  form.addEventListener("submit", updateProfileForm.handle);
  validations.instanceRules(rules, form);
};
