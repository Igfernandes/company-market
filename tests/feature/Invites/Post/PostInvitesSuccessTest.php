<?php

namespace Tests\Feature\Invites\Post;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Mocks\Notifications\NotificationsMock;
use Tests\Support\Sessions\AuthenticatedSession;

class PostInvitesSuccessTest extends NotificationsMock
{
    use FeatureTestTrait, AuthenticatedSession;

    private string $route = '/api/invites/user';
    const PAYLOAD =  [
        'name' => 'Company Test',
        'email' => 'companymarketbanks@gmail.com',
        'role_id' => 1
    ];

    /**
     * Cenário: payload inválido causa exceção
     */
    public function testSendInvite()
    {
        $this->createAuthenticatedSession(1);

        $result = $this->post($this->route, SELF::PAYLOAD);

        $result->assertJSONFragment([
            "success" => "Api.invites.success.post"
        ]);
        $result->assertStatus(ResponseInterface::HTTP_CREATED);
    }
}
