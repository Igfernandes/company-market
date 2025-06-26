<?php

namespace App\Business\Exports;

use App\Business\BaseBusiness;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Reader\Html as HtmlReader;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportsBusiness
{
    use BaseBusiness;

    /** 
     * @param string $entity
     * @param array $data
     */
    public static function pdf(string $entity, array $data): string
    {
        helper("files");
        $dompdf = new Dompdf();

        $dompdf->loadHtml(view("pdfs/$entity", $data));

        // Define papel e orientação
        $dompdf->setPaper('A4', 'portrait');

        // Renderiza
        $dompdf->render();

        // Gera o conteúdo do PDF como string
        $pdfOutput = $dompdf->output();

        // Define o caminho onde será salvo
        $filename = "{$entity}_" . time() . '.pdf';
        $path = WRITEPATH . "/uploads/pdfs/$entity/" . $filename;

        // Cria a pasta se não existir
        if (!file_exists(dirname($path))) {
            mkdir(dirname($path), 0777, true);
        }
        // Salva o arquivo no disco
        file_put_contents($path, $pdfOutput);

        // Retorna a URL
        return getPublicUrl($path);
    }

    /** 
     * @param string $entity
     * @param array $data
     */
    public static function excel(string $entity, array $data): string
    {
        helper("files");
        // Lê o HTML como planilha
        $reader = new HtmlReader();
        $spreadsheet = $reader->loadFromString(view("excels/$entity", $data));

        $title = $data['title'] ?: "export";
        // Define o nome e caminho do arquivo Excel
        $filename = "{$title}_" . time() . '.xlsx';
        $path = WRITEPATH . '/uploads/excels/' . $filename; // Pasta local

        // Garante que a pasta exista
        if (!file_exists(dirname($path))) {
            mkdir(dirname($path), 0777, true);
        }

        // Salva o Excel no servidor
        $writer = new Xlsx($spreadsheet);
        $writer->save($path);

        // Retorna a URL
        return getPublicUrl($path);
    }
}
