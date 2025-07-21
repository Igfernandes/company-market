<?php

namespace App\Business\Fields;

use App\Business\BaseBusiness;
use App\Business\Files\FilesBusiness;
use Config\Services;

class FieldsComponentsBusiness
{
    use BaseBusiness;

    public static function file(string $settingsFile): string
    {
        $filesSettings = \json_decode($settingsFile);
        $cache = Services::cache();

        if (\gettype($filesSettings) === "string")
            return $settingsFile;

        $attemptsFiles = $cache->get($filesSettings->package) ?? [];

        $filesUploaded =  FilesBusiness::restore(\array_filter(
            $attemptsFiles,
            function ($attemptFile) use ($filesSettings) {
                $paths = \explode("attempts/", $attemptFile);

                if (count($paths) != 2) {
                    return false;
                }

                $filesInAttemptsPath = strstr($filesSettings->file, $paths[1]) !== false;

                if ($filesInAttemptsPath) {
                    return true;
                } else {
                    \unlink(\str_replace("\\", "/", WRITEPATH . "uploads\\attempts\\" . $paths[1]));
                    return false;
                }
            }
        ));

        $cache->delete($filesSettings->package);
        return $filesUploaded[0];
    }

    public static function gallery(string $value): string
    {
        $filesSettings = \json_decode($value);
        $cache = Services::cache();
        $attemptsFiles = $cache->get($filesSettings->package);

        if(empty($attemptsFiles))
            return json_encode($filesSettings->files);

        $filesUploaded =  FilesBusiness::restore(\array_filter(
            $attemptsFiles,
            function ($attemptFile) use ($filesSettings) {
                $paths = \explode("attempts/", $attemptFile);

                if (count($paths) != 2) {
                    return false;
                }
                if (empty($filesSettings->files) || !$filesSettings->files)
                    return false;

                $filesInAttemptsPath = \array_filter($filesSettings->files, fn($file) => strstr($file, $paths[1]) !== false);

                if (\count($filesInAttemptsPath) > 0) {
                    return true;
                } else {
                    \unlink(\str_replace("\\", "/", WRITEPATH . "uploads\\attempts\\" . $paths[1]));
                    return false;
                }
            }
        ));

        $cache->delete($filesSettings->package);
        return \json_encode($filesUploaded);
    }
}
