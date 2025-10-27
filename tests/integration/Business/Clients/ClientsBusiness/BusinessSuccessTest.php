<?php

namespace Tests\Integration\Business\Clients\ClientsBusiness;

use App\Business\Clients\ClientsBusiness;
use App\Database\Models\Clients\ClientsModel;
use Tests\Support\Mocks\Clients\ClientsMock;

class BusinessSuccessTest extends ClientsMock
{
    protected $namespace = 'App';

    private ClientsBusiness $business;
    protected function setUp(): void
    {
        parent::setUp();

        $this->business = new ClientsBusiness();
    }

    public function testReturnExistInHasMethod()
    {
        $clientsModel = new ClientsModel();
        $found = $clientsModel->first();

        $hasClient = $this->business->has([
            'id' => $found->getId()
        ]);

        $this->assertTrue($hasClient);
    }
}
