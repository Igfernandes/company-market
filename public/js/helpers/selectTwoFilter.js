export function selecTwoFilter(selectClass, filters = []){
    const elements = document.querySelectorAll(`${selectClass} .select2-results__option`)

    filters.forEach((filter)=>{
        elements.forEach(element => {
            if(element.id.indexOf(filter) == -1)
                element.style = "display: none"
            else element.style = "display: block";
        });
    })
}