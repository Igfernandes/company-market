export function removeSinalsString(stringCurrent) {
  const withSinals =
    "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝŔÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿŕ";
  const noSinals =
    "AAAAAAACEEEEIIIIDNOOOOOOUUUUYRsBaaaaaaaceeeeiiiionoooooouuuuybyr";

  let stringFiltered = "";
  for (let i = 0; i < stringCurrent.length; i++) {
    let trade = false;
    for (let a = 0; a < withSinals.length; a++) {
      if (stringCurrent.substr(i, 1) == withSinals.substr(a, 1)) {
        stringFiltered += noSinals.substr(a, 1);
        trade = true;
        break;
      }
    }
    if (trade == false) {
      stringFiltered += stringCurrent.substr(i, 1);
    }
  }
  return stringFiltered;
}
