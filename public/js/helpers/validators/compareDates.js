 function compareDates(dateStart, dateEnd,operator){
    const initialDate = new Date(dateStart).getTime();
    const finalDate = new Date(dateEnd).getTime();

    return eval(`${initialDate} ${operator} ${finalDate}`)
}