<?php


namespace App\Business\Fields;

use App\Business\BaseBusiness;
use App\Libraries\Exceptions\Exceptions;
use CodeIgniter\HTTP\Files\UploadedFile;

class FieldsFilesBusiness
{
    use BaseBusiness;

    /**
     * Valida se o arquivo não excede o tamanho máximo permitido
     *
     * @param UploadedFile $field Nome do campo do arquivo (ex: 'document')
     * @return void
     */
    public static function validateFileSize(UploadedFile $field): void
    {
        $request = $request ?? service('request');

        $file = $request->getFile($field);
        $maxSize = 5 * 1024 * 1024;

        if (!$file instanceof UploadedFile || $file->getError() !== UPLOAD_ERR_OK) {
            return; // Se não foi enviado ou houve erro, ignora a validação
        }

        if ($file->getSize() > $maxSize) {
            throw new Exceptions("Api.fields.invalid.file_1024");
        }
    }

    public static function upload(UploadedFile $file): string
    {;
        if (!$file->isValid())
            throw new Exceptions("Api.files.invalid.file", \BAD_BUSINESS_RULES);

        $extension = $file->getExtension();
        $fileName = date("Y_m_d-H_i_s") . "_field.$extension";

        $file->move(WRITEPATH . 'uploads/fields', $fileName);

        return WRITEPATH . "uploads\\fields\\$fileName";
    }
}
