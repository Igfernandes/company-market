export function union(reference, field){
    const referenceField = document.querySelector(`[name='${reference[0]}']`)

    if(!referenceField) 
        return console.log(`error_${reference}: Não foi possível encontrar o campo de referência`);
    if(referenceField.value == reference[1]) return !!field.value ? true : null

    return null;
}

export default {
    union
}