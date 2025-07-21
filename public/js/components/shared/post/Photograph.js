import { Div } from "../utils/div";
import { Input } from "../forms/input.js";
import { Button } from "../forms/button.js";
import { Trash } from "../../../assets/trash";
import { Image } from "../utils/img";
import { Label } from "../forms/label";
import { FormGroup } from "../forms/formGroup";

export function Post(
  { id = null, img = { src: "", alt: "" } },
  input = [
    {
      name: "",
      attributes: [],
    },
  ]
) {
  const post = Div({
    className:
      "row justify-content-center align-items-end mb-4 bg-light p-3 position-relative",
  });

  if (!id)
    throw new Error("Post: Não é possível criar um post sem passar o 'id'");

  const inputId = Input({
    name: "photograph[]",
    value: id,
    type: "hidden",
  });

  /** BTN DELETE */
  const deleteContent = Div({
    className: "delete w-100",
  });
  const deleteBox = Div({
    className: "delete_btn",
  });
  deleteContent.appendChild(deleteBox);
  deleteBox.appendChild(
    Button({
      className: "btn btn-danger",
      attributes: ['data-clone="remove"'],
      inner: Trash(),
    })
  );

  /** Column  */
  const columnLeft = Div({
    className: "col-12 col-sm-6 form-upload",
  });
  const boxImg = Div({
    className: "perfil-img",
    style: "height: 45vh;",
  });

  columnLeft.appendChild(boxImg);
  boxImg.appendChild(
    Image({
      src: img.src,
      style: "object-fit: contain",
      alt: img.alt,
    })
  );

  const boxInputPreview = Div({
    className: "custom-file",
  });
  const inputPreview = Input({
    className: "custom-file-input",
    attributes: [
      'type="file"',
      "data-preview",
      'name="banner[]"',
      'accept=".jpg, .jpeg, .png"',
    ],
  });
  const labelPreview = Label({
    className: "custom-file-label",
    for: id + "-fileInput",
  });
  const divPreview = Div({
    className: "invalid-feedback",
    text: "Faça o upload da sua fotografia!",
  });

  boxInputPreview.appendChild(inputPreview);
  boxInputPreview.appendChild(labelPreview);
  boxInputPreview.appendChild(divPreview);

  /** COLUMN - RIGHT */
  const columnRight = Div({
    className: "col-12 col-sm-6 form-upload pb-5",
  });

  input.forEach((input, key) => {
    const formGoup = FormGroup({
      id: key + input.name,
      ...input,
    });

    columnRight.appendChild(formGoup);
  });

  [deleteContent, inputId, columnLeft, columnRight].forEach((element) => {
    post.appendChild(element);
  });
}
