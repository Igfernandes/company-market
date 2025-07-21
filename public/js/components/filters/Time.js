import { Input } from "../shared/forms/input.js";
import { Span } from "../shared/utils/span.js";
import { RowFilter } from "./row.js";

export function TimeFilter(){

    this.create = (filtersContent) =>{

        /*Criando a linha onde adcionaremos o search*/
        const rowFilter = new RowFilter();
        let row = rowFilter.create(filtersContent);

        const form = filtersContent.querySelector('form');
        filtersContent.insertBefore(row, form);

        /*Criando e adicionando content dos inputs*/
        const div = document.createElement('div');
        div.classList = 'd-flex m-2';
        div.setAttribute("data-filter", "time");

        /*Content imput inicio*/
        const groupStart = document.createElement('div');
        groupStart.classList='d-flex align-items-center ml-2';
        groupStart.setAttribute("data-filter-target", 'time-start');

        const labelContent = document.createElement('label');
        labelContent.style='font-weight: normal; display: flex; align-items: center; margin-bottom:0px;';

        groupStart.appendChild(Span({
            text: 'Início'
        }))
        const inputStart = Input({
            name: 'inicio',
            type: 'date',
            className: 'ml-1 form-control form-control-sm',
        })
        groupStart.appendChild(inputStart)

        /*Content input fim*/
        const groupfinal = document.createElement('div');
        groupfinal.classList='d-flex align-items-center ml-1';
        groupfinal.setAttribute("data-filter-target", 'time-start');
 
        groupfinal.appendChild(Span({
            text: 'Fim'
        }))
        const inputfinal = Input({
            name: 'fim',
            type: 'date',
            className: 'ml-1 form-control form-control-sm',
        });
        groupfinal.appendChild(inputfinal)
        
        row.appendChild(div);
        div.appendChild(labelContent);
        labelContent.appendChild(groupStart);
        labelContent.appendChild(groupfinal);
        
        return  {
            start:  inputStart,
            final: inputfinal
        }
    } 
}