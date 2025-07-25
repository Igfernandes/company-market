<?php

namespace App\Api\Files\Post;

use App\Business\Files\FilesBusiness;
use App\Libraries\Exceptions\Exceptions;
use CodeIgniter\HTTP\Files\UploadedFile;
use Config\Services;

class PostUseCases
{
    /**
     * @param array{
     *  files: array{UploadedFile},
     *  package: string
     * } $payload
     */
    public function execute(array $payload)
    {
        \helper(["files"]);
        if (!is_array($payload['files']))
            throw new Exceptions("Api.files.invalid.files", BAD_REQUEST);

        $response = [
            "success" => "Api.files.success.post",
            "files" => [
                "success" => [],
                "failed" => []
            ],
        ];

        foreach ($payload['files'] as $index => $file) {
            if (!$file->isValid()) {
                $response['files']['failed'][] = $index;
                continue;
            }
            $response['files']['success'][] = getPublicUrl(FilesBusiness::attempt($file));
        }

        $cache = Services::cache();

        $filesToCache = $response['files']['success'];
        $filesAlreadySavedCache = $cache->get($payload['package']);

        if (is_array($filesAlreadySavedCache) && count($filesAlreadySavedCache) > 0) {
            $filesToCache = [...$filesToCache, ...$filesAlreadySavedCache];
        }

        $cache->save($payload['package'], $filesToCache);

        return $response;
    }
}
