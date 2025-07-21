export function sliceArray(array, maxLength) {
  return array.reduce((acumulador, item, indice) => {
    const grupo = Math.floor(indice / maxLength);
    acumulador[grupo] = [...(acumulador[grupo] || []), item];
    return acumulador;
  }, []);
}
