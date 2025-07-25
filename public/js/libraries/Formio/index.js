import { builderConfig } from "./builder.js";

export function FormBuilder() {
  this.builder = async (content, fields) => {
    return await Formio.builder(
      content,
      {
        components: fields,
      },
      builderConfig
    );
  };

  this.create = async (content, fields) => {
    return await Formio.createForm(content, {
      components: fields,
    });
  };
}
