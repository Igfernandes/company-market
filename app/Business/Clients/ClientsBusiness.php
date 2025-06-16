<?php


namespace App\Business\Clients;

use App\Business\BaseBusiness;
use App\Database\Entities\Clients\ClientEntity;
use App\Database\Models\Clients\ClientsModel;
use App\Libraries\Crypto\Crypto;

class ClientsBusiness
{
    use BaseBusiness;
    private ClientsModel $clientsModel;

    public function __construct()
    {
        $this->clientsModel = new ClientsModel();
    }

    public function store($payload, $userAuthId): int|false
    {
        helper(['crypto']);

        if (!$this->hasClientByPhone($payload['phone']))
            return false;

        $clientEntity = new ClientEntity();

        $crypto = new Crypto();
        $systemKey = $crypto->encrypt($payload['name'] . ":" . $payload['phone'], getenv('system.encrypted_key'));

        $clientEntity->setSystemKey($systemKey);
        $clientEntity->setName($payload['name']);
        $clientEntity->setStatus('ACTIVE');
        $clientEntity->setPhoneSha256(\referenceHash($payload['phone']));
        $clientEntity->setOwnerId($userAuthId);
        $clientEntity->setEncryptPhone($payload['phone']);

        /** @var ClientEntity */
        $foundClientWithPhone = $this->clientsModel->where("phone_sha256", $clientEntity->getPhoneSha256())->first();
        if (!empty($foundClientWithPhone))
            return $foundClientWithPhone->getId();

        if (!empty($payload['birthdate']))
            $clientEntity->setBirthdate($payload['birthdate']);
        if (!empty($payload['email']))
            $clientEntity->setEncryptEmail($payload['email']);
        if (!empty($payload['avatar']))
            $clientEntity->setAvatar($payload['avatar']);

        $this->clientsModel->save($clientEntity);

        return $this->clientsModel->getInsertID();
    }

    public function hasClientByPhone(string $phone): bool
    {
        \helper(['crypto']);
        $clientsModel = new ClientsModel();

        $foundClient = $clientsModel->where("phone_sha256", \referenceHash($phone))->first();

        return !empty($foundClient);
    }


    public function hasClient(int $clientId): bool
    {
        $clientsModel = new ClientsModel();

        $foundClient = $clientsModel->where("id", $clientId)->first();

        return !empty($foundClient);
    }

    public function hasClients(array $clientsId): bool
    {
        $clientsModel = new ClientsModel();

        $foundClients = $clientsModel->whereIn("id", $clientsId)->findAll();

        return count($foundClients) === \count($clientsId);
    }
}
