export function RemoveFiles(){

    this.handle = (ev) => {

        const field = ev.currentTarget;
        const group = field.closest('[data-clear]');
        const activeValue = group.dataset.clearValue.split("/");
        const groupName = group.dataset.clear.split("/");
        const inputField = document.querySelector(`[data-clear-input='${groupName}']`);
        let status = false;

        if (field.value == activeValue) {
            status = false
        } else {
            status = true
        }
        if(status == true){
            if(inputField.files[0]){
                inputField.value = '';
                const label = document.querySelector(`[data-clear-label='${groupName}']`);
                label.innerText = 'Anexar o documento';
            }
        }   
    }
}