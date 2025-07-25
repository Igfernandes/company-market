export function NameFiles(){

    this.handle = (ev) => {
        const fieldFile = ev.currentTarget
        if(!fieldFile) throw new Error("Não foi possível encontrar o arquivo de referência. [error_file_name]");

        const [file] = fieldFile.files
        const referenceLabel = fieldFile.dataset.file 
        const label = document.querySelector(`[data-file-label='${referenceLabel}']`)
        if(!file) return false;
        if(!label) throw new Error(`Não foi possível encontrar o arquivo de referência. [error_file_name: ${referenceLabel}]`);
    
        return label.innerText = file.name;
    }
}

