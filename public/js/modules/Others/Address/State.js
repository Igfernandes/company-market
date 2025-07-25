import { Ajax } from "../../../libs/Ajax/index.js";
import { City } from "./City.js";

export function State(){
    
    this.handle = async (ev) =>{
        const element = ev.currentTarget ?? ev
        const ajax = new Ajax();
        const city = new City();
        const {cityTarget} = element.dataset
       
        const {data: response} = await ajax.get(`${window.location.origin}/json/address/state.json`) 

        if(!response) throw new Error("Não foi possível carregar os países");
        
        element.innerHTML = '<option value=""> Selecione </option>"';
        response.map(({UF, Estado})=>{
            if (element.dataset.state == UF) {
                element.innerHTML += '<option value="' + UF + '" selected>' + Estado + '</option>'
                if(cityTarget) city.handle(cityTarget, {state: UF});
            } else {
                element.innerHTML += '<option value="' + UF + '">' + Estado + '</option>'
            }
        })

        $(`[name='${element.name}']`).select2();
        $(`[name="${ev.name}"]`).on('select2:select', function (e) {
            if(cityTarget) city.handle(cityTarget, {state: element.value})
        });

    }
}