import { InputFile } from "../../../components/shared/forms/inputFile.js";
import { NameFiles } from "../Files/Name.js";

export function AddArchive(){

    this.handle = (ev) => {
        const field = ev.currentTarget;
        const boxContent = field.closest('div').querySelector('.box-upload')
        let ipt_file = new InputFile();
        const nameFiles = new NameFiles();
        let content = document.createElement("div");
        
        content.className = 'upload-item d-flex mb-4 mt-2'
        boxContent.appendChild(content)
        
        let list = [
                {
                    class: 'upload-item-name col-12 col-md-5 pr-1 pl-2',
                    el: 'name'
                },
                {
                    class: 'upload-item--archive col-12 col-md-7 pr-2 pl-1',
                    el: 'input'
                }
            ];
    
        for (let item of list) {
            let div = document.createElement('div')
            
            div.className = item.class
            content.appendChild(div);
            
            if (item.el == 'name') {
                div.appendChild(ipt_file.fileName())
            } else if (item.el == 'input') {
                const input = ipt_file.input();

                div.appendChild(input);
                input.querySelector('input').addEventListener('change', nameFiles.handle) ;
            }
        }
    }
}