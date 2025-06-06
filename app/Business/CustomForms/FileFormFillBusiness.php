<?php

namespace App\Business\CustomForms;

use App\Libraries\Exceptions\Exceptions;
use CodeIgniter\HTTP\Files\UploadedFile;

class FileFormFillBusiness
{
    public static function upload(UploadedFile $photo): string
    {
        if (!$photo->isValid())
            throw new Exceptions(lang("Api.services.invalid.photo"));

        $extension = $photo->getExtension();
        $photoName = date("Y_m_d-H_i_s") . "_file.$extension";

        $photo->move(WRITEPATH . 'uploads\forms', $photoName);

        return WRITEPATH . "uploads\forms\\$photoName";
    }
}
