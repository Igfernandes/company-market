<?php

namespace App\Api\Operations\Companies\Patch\logotype;

use App\Business\Companies\CompaniesBusiness;
use App\Database\Entities\Users\UserEntity;
use App\Database\Models\Companies\CompaniesModel;
use App\Libraries\Exceptions\Exceptions;
use App\Services\Notifications\NotificationsService;
use CodeIgniter\HTTP\Response;

class PatchLogotypeUseCases
{
    /**
     * Processa um payload contendo informações detalhadas do arquivo de imagem.
     *
     * @param array{
     *   id: int,
     *   file: object{
     *     fullName: string,       // Nome completo do arquivo (ex: "e1038407-be21-4930-aec1-0a78dd3eba1b.png")
     *     name: string,           // Nome sem extensão (ex: "e1038407-be21-4930-aec1-0a78dd3eba1b")
     *     extension: string,      // Extensão do arquivo (ex: "png")
     *     mimeType: string,       // Tipo MIME (ex: "image/png")
     *     imageCanvas: \stdClass, // Objeto de metadados ou contexto do canvas (pode estar vazio)
     *     imageBase64: string,    // Dados da imagem codificados em Base64
     *     width: int,             // Largura da imagem em pixels
     *     height: int             // Altura da imagem em pixels
     *   }
     * } $payload
     *
     * @return void
     */
    public function execute(array $payload)
    {
        helper(['uploads']);
        $session = session();

        /** @var UserEntity */
        $userAuth = $session->get(SESSION_KEY_AUTH_USER);

        if (empty($userAuth))
            throw new Exceptions("Api.companies.invalid.not_found", Response::HTTP_NOT_FOUND);

        $companiesBusiness = new CompaniesBusiness();
        $companyId = $payload['id'];

        $logotype = saveBase64ToUploads($payload['file']->imageBase64, $payload['file']->name);

        $response =  (object)[
            "file" => $logotype,
            "success" => "Api.companies.success.patch.photo"
        ];

        if ($companyId === 0)
            return $response;

        if (!$companiesBusiness->has([
            "id" => $companyId
        ]))
            throw new Exceptions("Api.companies.invalid.not_found", Response::HTTP_NOT_ACCEPTABLE);

        $companiesModel = new CompaniesModel();

        $companiesModel->set("logotype", $logotype)->update($companyId);

        NotificationsService::store([
            "scope" => "companies",
            "action" => "UPDATE",
            "key" => $companyId
        ]);

        return $response;
    }
}
