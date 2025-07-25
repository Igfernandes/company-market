export function capitalize(str){
    if (typeof str !== 'string') {
        return '';
    }
    return str.split(" ").map((strItem)=>{
        return strItem.charAt(0).toUpperCase() + strItem.substr(1)
    }).join(" ");
}