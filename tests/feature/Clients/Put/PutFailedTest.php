<?php

namespace Tests\Feature\Clients\Put;

use CodeIgniter\HTTP\Response;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Mocks\Clients\ClientsMock;
use Tests\Support\Sessions\AuthenticatedSession;

class PutFailedTest extends ClientsMock
{
    use FeatureTestTrait, AuthenticatedSession;

    private string $route = '/api/clients';

    /**
     * Cenário: payload inválido causa exceção
     */
    public function testReturnErrorByIdIncorrect()
    {
        $this->createAuthenticatedSession(1);

        $payload = SELF::DATA[0];
        $payload['category'] = 1;
        unset($payload['id']);

        $result = $this->withBody(json_encode($payload), 'application/json')->put("{$this->route}/999");

        $result->assertStatus(Response::HTTP_NOT_ACCEPTABLE);
    }


    public function testMissingRequiredName()
    {
        $this->createAuthenticatedSession(1);
        $payload = [
            // faltando: name, type, manufacturer, model
            'status' => 'AVAILABLE',
        ];

        $result = $this->withBody(json_encode($payload), 'application/json')
            ->put("{$this->route}/1");

        $result->assertStatus(Response::HTTP_BAD_REQUEST);
        $result->assertJSONFragment(['error' => 'Api.clients.invalid.name']);
    }

    /**
     * 
     * Cenário: campos obrigatórios ausentes devem retornar erro de validação
     */
    public function testMissingRequiredPhone()
    {
        $this->createAuthenticatedSession(1);
        $payload = [
            'name' => 'AAA',
            'category' => 1,
            'status' => 'ACTIVE',
            'photo' => 'http://local.com/photo'
        ];

        $result = $this->withBody(json_encode($payload), 'application/json')
            ->put("{$this->route}/1");

        $result->assertStatus(Response::HTTP_BAD_REQUEST);
        $result->assertJSONFragment(['error' => 'Api.clients.invalid.phone']);
    }

    /**
     * Cenário: strings com tamanho excessivo devem falhar
     */
    public function testInvalidNameLengthLimit()
    {
        $this->createAuthenticatedSession(1);
        $longString = str_repeat('A', 200);

        $payload = [
            'name' => $longString,
            'category' => 1,
            'phone' => '5521865954784',
            'photo' => 'http://local.com/photo',
        ];

        $result = $this->withBody(json_encode($payload), 'application/json')
            ->put("{$this->route}/1");

        $result->assertStatus(Response::HTTP_BAD_REQUEST);
        $result->assertJSONFragment(['error' => 'Api.clients.invalid.name']);
    }

    /**
     * Cenário: strings com tamanho excessivo devem falhar
     */
    public function testStringLengthPhoneLimit()
    {
        $this->createAuthenticatedSession(1);
        $longString = str_repeat('A', 200);

        $payload = [
            'name' => "Barco",
            'phone' => $longString,
            'status' => 'ACTIVE',
            'category' => 1,
            'photo' => 'http://local.com/photo',
        ];

        $result = $this->withBody(json_encode($payload), 'application/json')
            ->put("{$this->route}/1");

        $result->assertStatus(Response::HTTP_BAD_REQUEST);
        $result->assertJSONFragment(['error' => 'Api.clients.invalid.phone']);
    }

    /**
     * Cenário: strings com tamanho excessivo devem falhar
     */
    public function testInvalidBirthdateLimit()
    {
        $this->createAuthenticatedSession(1);
        $longString = str_repeat('A', 200);

        $payload = [
            'name' => "AAA",
            'phone' => '5521865954784',
            'birthdate' => $longString,
            'category' => 1,
            'photo' => 'http://local.com/photo',
            'status' => 'ACTIVE',
        ];

        $result = $this->withBody(json_encode($payload), 'application/json')
            ->put("{$this->route}/1");

        $result->assertStatus(Response::HTTP_BAD_REQUEST);
        $result->assertJSONFragment(['error' => 'Api.clients.invalid.birthdate']);
    }

    /**
     * Cenário: strings com tamanho excessivo devem falhar
     */
    public function testInvalidEmailLimit()
    {
        $this->createAuthenticatedSession(1);
        $longString = str_repeat('A', 300);

        $payload = [
            'name' => "Bianca",
            'phone' => '5521865954784',
            'birthdate' => "1990-10-10",
            'photo' => 'http://local.com/photo',
            'status' => 'ACTIVE',
            'category' => 1,
            'email' => $longString
        ];

        $result = $this->withBody(json_encode($payload), 'application/json')
            ->put("{$this->route}/1");

        $result->assertStatus(Response::HTTP_BAD_REQUEST);
        $result->assertJSONFragment(['error' => 'Api.clients.invalid.email']);
    }

    /**
     * Cenário: strings com tamanho excessivo devem falhar
     */
    public function testInvalidDocumentLimit()
    {
        $this->createAuthenticatedSession(1);
        $longString = str_repeat('A', 200);

        $payload = [
            'name' => "Bianca",
            'birthdate' => "1990-10-10",
            'photo' => 'http://local.com/photo',
            'status' => 'ACTIVE',
            'phone' => '5521865954784',
            'email' => 'bianca@gmail.com',
            'category' => 1,
            'document' => $longString
        ];

        $result = $this->withBody(json_encode($payload), 'application/json')
            ->put("{$this->route}/1");

        $result->assertStatus(Response::HTTP_BAD_REQUEST);
        $result->assertJSONFragment(['error' => 'Api.clients.invalid.document']);
    }

    /**
     * Cenário: strings com tamanho excessivo devem falhar
     */
    public function testInvalidDocumentTypeLimit()
    {
        $this->createAuthenticatedSession(1);
        $longString = str_repeat('A', 200);

        $payload = [
            'name' => "Bianca",
            'birthdate' => "1990-10-10",
            'photo' => 'http://local.com/photo',
            'status' => 'ACTIVE',
            'phone' => '5521865954784',
            'email' => 'bianca@gmail.com',
            'document' => '17222534792',
            'category' => 1,
            'document_type' => $longString
        ];

        $result = $this->withBody(json_encode($payload), 'application/json')
            ->put("{$this->route}/1");

        $result->assertStatus(Response::HTTP_BAD_REQUEST);
        $result->assertJSONFragment(['error' => 'Api.clients.invalid.document_type']);
    }

    /**
     * Cenário: strings com tamanho excessivo devem falhar
     */
    public function testInvalidStatusType()
    {
        $this->createAuthenticatedSession(1);

        $payload = [
            'name' => "Bianca",
            'birthdate' => "1990-10-10",
            'photo' => 'http://local.com/photo',
            'status' => 'none',
            'email' => 'bianca@gmail.com',
            'document' => '17222534792',
            'document_type' => "CPF"
        ];

        $result = $this->withBody(json_encode($payload), 'application/json')
            ->put("{$this->route}/1");

        $result->assertStatus(Response::HTTP_BAD_REQUEST);
        $result->assertJSONFragment(['error' => 'Api.clients.invalid.status']);
    }
}
