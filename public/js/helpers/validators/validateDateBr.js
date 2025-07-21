export function validateDateBR(date, label){
    const log = [];
    const arrDate = date.split("/");
    let labelText = ''

    if(label) labelText = `: "${label}"`;

    if (arrDate[0] > 31) {
        log.push(`O dia precisa ser válido${labelText}`);
    } else if (arrDate[1] > 12) {
        log.push(`O mês precisa ser válido${labelText}`);
    } 

    return log;
}