import { getUrlBase } from "../../../helpers/getUrlBase.js";
import { locations } from "./locations.js";

export function PreviewFiles(){

    this.handle = (ev) => {
        const field = ev.currentTarget;
        const {modalPreview} = locations
        const {uploadUrl: fileUrl , uploadType: fileExtension} = field.dataset
        const refInput = field.dataset.filePreviewTarget
        const inputFile = document.querySelector(`[data-ref='${refInput}']`)

        if(!fileUrl) throw new Error(`error_preview_files: O campo não encontra-se com o link do arquivo [${inputFile.ref ?? inputFile.name}]`)
        if(!fileExtension) throw new Error(`error_preview_files: A extesão do arquivo não encontra-se [${inputFile.ref ?? inputFile.name}]`)

        // if(!modalPreview.classList.contains("show")) throw new Error(`error_priview_files: O modal não está aberto [${ref ?? field.name}]`);
 
        /**
         *                                               !!!!! ATENÇÃO !!!!
         *  SERÁ NECESSÁRIO REFATORAR O BACKEND PARA QUE RETORNE APENAS A STRING DO CAMINHO CORRETO PARA EXIBIÇÃO */

        const embedOfModal = modalPreview.querySelector("[data-file-preview-target='embed']")
        const linkOfEmbedModal = modalPreview.querySelector("[data-file-preview-target='link']")

        if(!embedOfModal) throw new Error(`error_preview_files: O embed não pode ser encontrado dentro do modal [${inputFile.ref ?? inputFile.name}]`);
        if(!linkOfEmbedModal) console.log(`error_preview_files: A tag "a" não pode ser encontrado dentro do modal [${inputFile.ref ?? inputFile.name}]`);

        linkOfEmbedModal.src = getUrlBase(fileUrl);

        embedOfModal.type = fileExtension;
        embedOfModal.src = getUrlBase(fileUrl);
    }
}