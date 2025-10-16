<?php

namespace App\Api\Operations\Users\Patch\Avatar;

use App\Business\Users\UsersBusiness;
use App\Database\Entities\Users\UserEntity;
use App\Database\Models\Users\UsersModel;
use App\Libraries\Exceptions\Exceptions;
use App\Services\Notifications\NotificationsService;
use CodeIgniter\HTTP\ResponseInterface;

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
            throw new Exceptions("Api.users.invalid.not_found", ResponseInterface::HTTP_NOT_FOUND);

        $usersBusiness = new UsersBusiness();
        $userId = $payload['id'];

        if (!$usersBusiness->hasUser([
            "id" => $userId
        ]))
            throw new Exceptions("Api.users.invalid.not_found", \BAD_BUSINESS_RULES);

        $usersModel = new UsersModel();

        $avatar = saveBase64ToUploads($payload['file']->imageBase64, $payload['file']->name);
        $usersModel->set("avatar", $avatar)->update($userId);

        if ($userAuth->getId() === $userId) {
            $userAuth->setAvatar($avatar);
            $session->set(SESSION_KEY_AUTH_USER, $userAuth);
        }

        NotificationsService::store([
            "scope" => "users",
            "action" => "UPDATE"
        ]);

        return (object)[
            "file" => $avatar,
            "success" => "Api.users.success.patch.photo"
        ];
    }
}
