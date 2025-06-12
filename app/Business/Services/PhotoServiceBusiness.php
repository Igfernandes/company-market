<?php

namespace App\Business\Services;

use App\Libraries\Exceptions\Exceptions;
use CodeIgniter\HTTP\Files\UploadedFile;

class PhotoServiceBusiness
{
    public function upload(UploadedFile $photo): string
    {
        if (!$photo->isValid())
            throw new Exceptions("Api.services.invalid.photo");

        $extension = $photo->getExtension();
        $photoName = date("Y_m_d-H_i_s") . ".$extension";

        $photo->move(WRITEPATH . 'uploads/services', $photoName);

        return WRITEPATH . "uploads\\services\\$photoName";
    }
}
