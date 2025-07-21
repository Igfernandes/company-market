export function Loading(){
    this.enable = (targeElement)=> {
        const element = document.querySelector(targeElement);
        const loading = document.createElement("img");
        
        loading.src = '/img/load.gif';

        element.setAttribute("disabled", true);
        element.style = 'display: none';
        element.parentNode.insertBefore(loading, reference.nextSibling)
    }
    
    this.disable = (targeElement)=> {
        const element = document.querySelector(targeElement);
    }
}