export function validateBirhtdateBR(date, faixa, label){
    const arrDate = date.split("/")
    const now = new Date();
    const logs = [];
    let labelText = '';

    if(label) labelText = `: "${label}"`

    if (parseInt(arrDate[2]) > (parseInt(now.getFullYear()) - faixa)) {
        logs.push(`Precisa ser idade superior a ${parseInt(now.getFullYear()) - faixa}${labelText}`); 
    } else if (parseInt(arrDate[2]) == parseInt(now.getFullYear())) {
        if (arrDate[1] > now.getMonth()) {
            logs.push(`Precisa ser idade superior a ${parseInt(now.getFullYear()) - faixa}${labelText}`);
        }
    }

    return logs;
}