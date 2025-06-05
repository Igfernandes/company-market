<?php

if (!function_exists('saveBase64ToUploads')) {

    /**
     * Salva uma imagem base64 diretamente em WRITEPATH . 'uploads'
     *
     * @param string $base64String Conteúdo base64 da imagem (ex: data:image/png;base64,...)
     * @param string $photoName Nome final do arquivo, com extensão (ex: imagem.png)
     * @return string Caminho completo do arquivo salvo
     */
    function saveBase64ToUploads(string $base64String, string $photoName): string
    {
        // Extrai o tipo mime e os dados do base64
        if (preg_match('/^data:(.*?);base64,(.*)$/', $base64String, $matches)) {
            $mimeType = $matches[1]; // Tipo mime (image/png, image/jpeg, etc.)
            $data = base64_decode($matches[2]);
        } else {
            throw new \InvalidArgumentException('Formato base64 inválido.');
        }

        if ($data === false) {
            throw new \RuntimeException('Falha ao decodificar os dados base64.');
        }

        // Define o caminho de destino
        $uploadPath = WRITEPATH . 'uploads\services\\';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0775, true); // Cria o diretório se não existir
        }

        $extension = explode("/",  $mimeType)[1];
        $filePath = $uploadPath . "$photoName.$extension";

        // Salva a imagem no destino
        if (file_put_contents($filePath, $data) === false) {
            throw new \RuntimeException('Falha ao salvar o arquivo.');
        }

        return $filePath;
    }
}
