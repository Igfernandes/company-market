export function EnableFields(){

    this.handle = (ev) => {
        const field = ev.currentTarget;
        const group = field.closest('[data-enable]') 
        const fieldsToEnable = group.dataset.enable.split("/");
        const activeValue = group.dataset.enableValue.split("/");
        let status = false;

        if (field.value == activeValue) {
            status = false
        } else {
            status = true
        }

        fieldsToEnable.forEach((fieldToEnable)=>{
            if(!fieldToEnable) return;

            const input = document.querySelector(`[name='${fieldToEnable}']`);
            if(!input) throw new Error(`Não foi possível encontrar o campo para ativar [error_field_enable: ${fieldToEnable}]`)
            if(input.tagName == 'SELECT' && status == false){
                input.removeAttribute('disabled')
                return
            }else if(input.tagName == 'SELECT' && status == true){
                input.setValue('Não')
                input.setAttribute('disabled',true)
                return
            }

            input.readonly = status;
            input.disabled = status;
            input.setValue('');
        })
    }
}