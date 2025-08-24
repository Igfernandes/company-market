export function getDataInObject(index, object, separator = ".") {
  const proprietiesList = String(index).split(separator);

  return proprietiesList.reduce((acc, key) => {
    return acc && acc[key] !== undefined ? acc[key] : undefined;
  }, object);
}
