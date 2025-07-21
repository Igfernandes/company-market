import { capitalize } from "../../helpers/capitalize.js";
import { Select } from "../shared/forms/select/index.js";
import { Option } from "../shared/forms/select/option.js";
import { RowFilter } from "./row.js";

export function SelectFilter(){

    this.create = (filtersContent, {selects}) =>{   
        const elements = {};

        /*Criando a linha onde adcionaremos o search*/
        const rowFilter = new RowFilter();
        let row = rowFilter.create(filtersContent);

        const form = filtersContent.querySelector('form');
        filtersContent.insertBefore(row,form);

        /*Criando e adicionando content do select*/
        const div = document.createElement('div');
        div.classList='d-flex m-2';
        div.setAttribute("data-filter", "select");

        row.appendChild(div);

        Object.entries(selects).forEach(([label, options])=>{
            /*Criando e adicionando o select*/
            const select = Select({
                name: label,
                className: 'form-group mb-0 mx-2 form-control filter-select-'+label
            });
            const optionDefault = Option({
                value: '',
                text: `Escolha ${label}`
            });
            select.appendChild(optionDefault);
    
            /*Criando e adicionando options do select*/
            options.forEach(({value, label})=>{
                const option = Option({
                    value,
                    text: capitalize(label)
                });
                select.appendChild(option)
            })
            
            div.appendChild(select);
            elements[label] = select;

            $('.filter-select-'+label).select2()
        })

        return elements
    }
}