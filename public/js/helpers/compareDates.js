function compareDates(dateTarget = []){
    const dateNow = new Date();
    let responseYear = dateNow.getFullYear() - dateTarget[2];
    
    if(dateTarget[1] > dateNow.getMonth()){
        responseYear--;
    }
    return responseYear;
}

export default compareDates;