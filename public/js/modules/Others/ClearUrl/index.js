import { alertQueryStrings } from "../../../constants/alertQueryStrings.js";

export function ClearUrl(){

    this.handle = () => {
        const params = alertQueryStrings;
        let url = new URL(window.location.href);
        params.forEach((param)=>{
            if(url.searchParams.get(param)) url.searchParams.delete(param);
        })
        window.history.pushState('object or string', 'Title', url)
    }
}