export function resolvesPath(exports = {}, pathname) {
  if (exports[pathname]) return exports[pathname];
  else if (exports[pathname + "/"]) return exports[pathname + "/"];
  else if (exports[pathname.slice(0, -1)])
    return exports[pathname.slice(0, -1)];
  else if (exports[pathname.replace("/public", "")])
    return exports[pathname.replace("/public", "")];

  const matrizExports = Object.entries(exports);

  for (const [pathReference, imports] of matrizExports) {
    const pathBase = pathReference.replace("/*", "");
    const variablePathPosition = pathReference.split("/").indexOf("*");
    const arrPathReferences = pathname.split("/");

    if (variablePathPosition != -1 && pathname.indexOf(pathBase) != -1) {
      arrPathReferences[variablePathPosition] = "*";

      const indexOfExport = arrPathReferences.join("/");

      return exports[indexOfExport];
    }
  }
}
