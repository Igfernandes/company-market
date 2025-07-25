<?php

namespace App\Business\Files;

use App\Libraries\Exceptions\Exceptions;
use CodeIgniter\HTTP\Files\UploadedFile;

class FilesBusiness
{

    public static function attempt(UploadedFile $file): string
    {
        \helper(['crypto']);
        if (!$file->isValid())
            throw new Exceptions("Api.files.invalid.type");

        $extension = $file->getExtension();
        $fileName = date("Y_m_d-H_i_s") . referenceHash($file->getName()) . "_file.$extension";
        $absolutePath = WRITEPATH . 'uploads/attempts';

        $file->move($absolutePath, $fileName);

        return "$absolutePath/$fileName";
    }

    public static function restore(array $files)
    {
        $attemptPath = WRITEPATH . 'uploads/attempts';
        $destinyPath = WRITEPATH . 'uploads/files/' . date("Y") . '/' . date('m');

        $filesUploaded = [];
        foreach ($files as $publicUrlFile) {
            $paths = explode("attempts/", $publicUrlFile);

            if (count($paths) < 2 || !file_exists("$attemptPath/{$paths[1]}"))
                continue;

            if (!is_dir(dirname($destinyPath))) {
                mkdir($destinyPath, 0777, true);
            }

            $filesUploaded[] = "$destinyPath/{$paths[1]}";
            rename("$attemptPath/{$paths[1]}", "$destinyPath/{$paths[1]}");
        }

        return $filesUploaded;
    }

    public static function upload(UploadedFile $file): string
    {
        \helper(['crypto']);
        if (!$file->isValid())
            throw new Exceptions("Api.files.invalid.type");

        $extension = $file->getExtension();
        $photoName = date("Y_m_d-H_i_s") . referenceHash($file->getName()) . "_file.$extension";
        $absolutePath = WRITEPATH . 'uploads/files/' . date("Y") . '/' . date('m');

        $file->move($absolutePath, $photoName);

        return "$absolutePath/$photoName";
    }
}
