export function Excel() {
    this.table = document.querySelector("[data-table='export_excel']")
    this.btns = document.querySelectorAll("[data-table='export_excel_btn']")

    this.init = () => {
        for (const btn of this.btns) {
            btn.onclick = this.export
        }
    }

    this.export = () => {
        const name = this.table.dataset.export
        const table = this.table.cloneNode(true)
        table.querySelectorAll("tr td input").forEach(element => {
            if(!element.checked){
                element.closest("tr").remove()
            }
        });

        const file = XLSX.utils.table_to_book(table, { sheet: "sheet1" });

        XLSX.write(file, { bookType: 'xlsx', bookSST: true, type: 'base64' });
        XLSX.writeFile(file, name + '.xlsx');
    }
}

const cmd = new Excel();

document.addEventListener("DOMContentLoaded", () => {
    if (cmd.table) {
        cmd.init()
    }
})
