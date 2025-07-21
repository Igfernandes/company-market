const InputFile = function(){

    this.value = "";
    this.label = 'Anexar o documento';
    this.name = 'arquivo_link[]'; 

    this.fileName = () =>{
        
        const input = document.createElement('input');
        input.type = 'text';
        input.className = 'form-control';
        input.placeholder = 'Nome do arquivo';
        input.name = 'arquivo_nome[]';
        input.value = this.value;

        return input;
    }

    this.input = () => {
        const ref = document.querySelectorAll("[data-file]").length
        const div = document.createElement('div');
        div.className = 'custom-file';

        let input = document.createElement('input');
        input.type = 'file';
        input.className = 'custom-file-input';
        input.name = this.name;
        input.value = this.value;
        input.accept = '.jpg, .jpeg, .pdf';
        input.dataset.file = this.name + ref;

        let label = document.createElement("label")
        label.className = 'custom-file-label';
        label.for = 'arquivo_link';
        label.textContent = 'Anexar o documento';
        label.dataset.fileLabel = this.name + ref;

        let close = document.createElement("span");
        close.textContent = "x";
        close.className = 'remove-fileIpt';
        close.onclick = function(){
            this.closest(".upload-item").remove()
        }

        div.appendChild(input);
        div.appendChild(label);
        div.appendChild(close);

        return div;
    }
}

if(document.querySelector(".remove-fileIpt")){
    for(let close of document.querySelectorAll(".remove-fileIpt")){
        close.onclick = function(){
            if(document.querySelectorAll(".remove-fileIpt").length > 1){

                this.closest(".upload-item").remove()
            }else{
                alert("Deve deixar pelo menos um item")
            }
            
        }
    }
}

export{
    InputFile
}