<?php

namespace App\Api\Operations\Clients\Patch\Avatar;

use App\Business\Clients\ClientsBusiness;
use App\Business\Users\UsersBusiness;
use App\Database\Entities\Users\UserEntity;
use App\Database\Models\Clients\ClientsModel;
use App\Database\Models\Users\UsersModel;
use App\Libraries\Exceptions\Exceptions;
use App\Services\Notifications\NotificationsService;
use CodeIgniter\HTTP\Response;

class PatchAvatarUseCases
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
            throw new Exceptions("Api.clients.invalid.not_found", Response::HTTP_NOT_FOUND);

        $clientBusiness = new ClientsBusiness();
        $clientId = $payload['id'];

        $avatar = saveBase64ToUploads($payload['file']->imageBase64, $payload['file']->name);

        $response =  (object)[
            "file" => $avatar,
            "success" => "Api.clients.success.patch.photo"
        ];

        if ($clientId === 0)
            return $response;

        if (!$clientBusiness->has([
            "id" => $clientId
        ]))
            throw new Exceptions("Api.clients.invalid.not_found", Response::HTTP_NOT_ACCEPTABLE);

        $clientsModel = new ClientsModel();

        $clientsModel->set("avatar", $avatar)->update($clientId);

        NotificationsService::store([
            "scope" => "clients",
            "action" => "UPDATE",
            "key" => $clientId
        ]);

        return $response;
    }
}
