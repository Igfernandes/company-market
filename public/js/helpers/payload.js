export function formDataToJson(formData) {
  const jsonObject = {};

  for (const [key, value] of formData.entries()) {
    // Se a chave já existe, converte para array ou adiciona ao array existente
    if (jsonObject.hasOwnProperty(key)) {
      if (!Array.isArray(jsonObject[key])) {
        jsonObject[key] = [jsonObject[key]];
      }
      jsonObject[key].push(value);
    } else {
      jsonObject[key] = value;
    }
  }

  return jsonObject;
}
