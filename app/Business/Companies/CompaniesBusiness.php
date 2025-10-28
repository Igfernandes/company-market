<?php


namespace App\Business\Companies;

use App\Business\BaseBusiness;
use App\Database\Entities\Companies\CompanyEntity;
use App\Database\Models\Companies\CompaniesModel;
use App\Libraries\Crypto\Crypto;

class CompaniesBusiness
{
    use BaseBusiness;
    private CompaniesModel $companiesModel;

    public function __construct()
    {
        $this->companiesModel = new CompaniesModel();
    }

    public function store($payload, $userAuthId = null): int|false
    {
        helper(['crypto']);

        $companyEntity = new CompanyEntity();

        $phone = str_replace(['+', '-', ' ', '(', ')'], '', $payload['phone']);
        $phoneSha256 = referenceHash($phone);

        /** @var CompanyEntity */
        $found =  $this->companiesModel->where("phone_sha256", $phoneSha256)->first();

        if (!empty($found))
            return $found->getId();

        $crypto = new Crypto();
        $systemKey = $crypto->encrypt($payload['name'] . ":" . $phone, getenv('system.encrypted_key'));

        $companyEntity->setSystemKey($systemKey);
        $companyEntity->setName($payload['name']);
        $companyEntity->setStatus('ACTIVE');
        $companyEntity->setPhoneSha256($phoneSha256);
        $companyEntity->setOwnerId($userAuthId);
        $companyEntity->setEncryptPhone($phone);

        if (!empty($payload['inscribed_at']))
            $companyEntity->setInscribedAt($payload['inscribed_at']);
        if (!empty($payload['email']))
            $companyEntity->setEncryptEmail($payload['email']);
        if (!empty($payload['logotype']))
            $companyEntity->setLogotype($payload['logotype']);

        $this->companiesModel->save($companyEntity);

        return  $this->companiesModel->getInsertID();
    }

    public function hasByPhone(string $phone): bool
    {
        \helper(['crypto']);

        $found = $this->companiesModel->where("phone_sha256", \referenceHash($phone))->first();

        return !empty($found);
    }


    public function has(array $query): bool
    {
        $found =  $this->companiesModel->withDeleted(true)->where($query)->first();

        return !empty($found);
    }

    public function hasClients(array $clientsId): bool
    {

        $founds = $this->companiesModel->whereIn("id", $clientsId)->findAll();

        return count($founds) === \count($clientsId);
    }
}
