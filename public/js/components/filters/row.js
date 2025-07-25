export function RowFilter(){

    this.create = (content, {className, attributies, id} = {}) => {
        let row; 

        if(content.querySelector('.row-search')){
            row = content.querySelector('.row-search') ;
        }else{
            row = document.createElement('div');
            row.className = 'row-search d-flex flex-wrap my-3'; 
        }
        
        return row; 
    }
}