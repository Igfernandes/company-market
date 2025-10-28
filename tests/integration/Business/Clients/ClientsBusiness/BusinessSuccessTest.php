<?php

namespace Tests\Integration\Business\Clients\ClientsBusiness;

use App\Business\Clients\ClientsBusiness;
use App\Database\Models\Clients\ClientsModel;
use Tests\Support\Mocks\Clients\ClientsMock;

class BusinessSuccessTest extends ClientsMock
{
    protected $namespace = 'App';


    public function testReturnExistInHasMethod()
    {
        $business = new ClientsBusiness();
        $clientsModel = new ClientsModel();
        $found = $clientsModel->first();

        $hasClient = $business->has([
            'id' => $found->getId()
        ]);

        $this->assertTrue($hasClient);
    }
}
