/**
 * Redimensiona e comprime uma imagem até 1000x1000 e < 5MB.
 *
 * @param {File} file - Imagem original (File ou Blob)
 * @param {number} maxWidth - Largura máxima (padrão 1000)
 * @param {number} maxHeight - Altura máxima (padrão 1000)
 * @param {number} maxSizeMB - Tamanho máximo em MB (padrão 5)
 * @returns {Promise<File>} - Retorna uma nova imagem otimizada
 */
export async function optimizeImage(
  file,
  maxWidth = 1000,
  maxHeight = 1000,
  maxSizeMB = 5
) {
  const imageBitmap = await createImageBitmap(file);

  const ratio = Math.min(
    maxWidth / imageBitmap.width,
    maxHeight / imageBitmap.height,
    1
  );
  const width = Math.round(imageBitmap.width * ratio);
  const height = Math.round(imageBitmap.height * ratio);

  const canvas = document.createElement("canvas");
  const ctx = canvas.getContext("2d");
  canvas.width = width;
  canvas.height = height;

  ctx.drawImage(imageBitmap, 0, 0, width, height);

  let quality = 0.9;
  let blob = await new Promise((resolve) =>
    canvas.toBlob(resolve, "image/jpeg", quality)
  );

  // 🔁 Ajusta qualidade até ficar < 5MB
  while (blob.size > maxSizeMB * 1024 * 1024 && quality > 0.1) {
    quality -= 0.1;
    blob = await new Promise((resolve) =>
      canvas.toBlob(resolve, "image/jpeg", quality)
    );
  }

  const optimizedFile = new File([blob], file.name.replace(/\.\w+$/, ".jpg"), {
    type: "image/jpeg",
  });
  return optimizedFile;
}
/**
 * Reseta um elemento <input type="file">, limpando o arquivo selecionado.
 *
 * @param {HTMLInputElement} inputFile - Elemento de input do tipo file a ser resetado.
 * @returns {HTMLInputElement} - Retorna o novo elemento input (limpo).
 */
export function resetFileInput(inputFile) {
  inputFile.value = "";
}
