
/**
 * @developer fernandes(github: https://github.com/Igfernandes)
 * 
 * Cookie: Open source elaborado para ser uma tecnologia de validação de cookies.
 * version: 1.0.0
 */

document.addEventListener("DOMContentLoaded", ()=>{
    let btn = document.querySelector("[data-cookie]")
    let cmd = new Storage();

    if(cmd.select({
        termos: "terms"
    }) == false){
       
        setTimeout(()=>{
            document.querySelector("cookie").style= "opacity: 1";
        },500)

        btn.onclick = (ev)=>{
            ev.preventDefault();
            cmd.save("terms", "sim");
            document.querySelector("cookie").style= "opacity: 0";
            setTimeout(()=>{
                document.querySelector("cookie").remove()
            },800)
        }
    }else{
        document.querySelector("cookie").remove()
    }
})