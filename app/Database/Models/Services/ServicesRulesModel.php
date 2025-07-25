<?php

namespace App\Database\Models\Services;

use App\Database\Entities\Services\ClientServiceEntity;
use App\Database\Entities\Services\ServiceEntity;
use App\Traits\ModelTrait;
use CodeIgniter\Model;

class ServicesRulesModel extends Model
{
    use ModelTrait;

    protected $DBGroup          = 'default';
    protected $table            = 'services_rules';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Services\ServiceRuleEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['service_id', 'label', 'column', 'condition', 'value'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';

    public function getWithServices(array $ruleQuery, array $serviceQuery = []): array
    {
        $rulesQueryUpdated = $this->addPrefixInQuery($ruleQuery, "services_rules");
        $serviceQueryUpdated = $this->addPrefixInQuery($serviceQuery, "services");

        $model = $this->Select("services_rules.*, services.*,
        services_rules.name as rule_name, services_rules.id as rule_id, services_rules.created_at as rule_created_at, 
        services_rules.updated_at as rule_updated_at,
        services.name as service_name, services.id as service_id, services.created_at as service_created_at,
        services.updated_at as service_updated_at")
            ->join("services", "services.id = services_rules.service_id");

        if (\count($rulesQueryUpdated) > 0)
            $model->where($rulesQueryUpdated);

        $founds = $model->where($serviceQueryUpdated)->findAll();

        return array_map(function (ClientServiceEntity $clientServiceData) {
            $clientService = new ClientServiceEntity();
            $ServiceEntity = new ServiceEntity();

            /** @var array */
            $attributes = $clientServiceData->attributes;

            $ServiceEntity->store($attributes);
            $ServiceEntity->setId($attributes['service_id']);
            $ServiceEntity->setName($attributes['service_name']);
            $ServiceEntity->setCreatedAt($attributes['service_created_at']);
            $ServiceEntity->setUpdatedAt($attributes['service_updated_at']);

            $clientService->setClientId($attributes['client_id']);
            $clientService->setServiceId($attributes['service_id']);
            $clientService->setService($ServiceEntity);

            return $clientService;
        }, $founds);
    }
}
