<?php

namespace Tests\Feature\companies\Put;

use CodeIgniter\HTTP\Response;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Mocks\companies\companiesMock;
use Tests\Support\Sessions\AuthenticatedSession;

class PutFailedTest extends companiesMock
{
    use FeatureTestTrait, AuthenticatedSession;

    private string $route = '/api/companies';

    /**
     * Cenário: payload inválido causa exceção
     */
    public function testReturnErrorByIdIncorrect()
    {
        $this->createAuthenticatedSession(1);

        $payload = SELF::DATA[0];
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
        $result->assertJSONFragment(['error' => 'Api.companies.invalid.name']);
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
            'status' => 'ACTIVE',
            'photo' => 'http://local.com/photo'
        ];

        $result = $this->withBody(json_encode($payload), 'application/json')
            ->put("{$this->route}/1");

        $result->assertStatus(Response::HTTP_BAD_REQUEST);
        $result->assertJSONFragment(['error' => 'Api.companies.invalid.phone']);
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
            'phone' => '5521865954784',
            'photo' => 'http://local.com/photo',
        ];

        $result = $this->withBody(json_encode($payload), 'application/json')
            ->put("{$this->route}/1");

        $result->assertStatus(Response::HTTP_BAD_REQUEST);
        $result->assertJSONFragment(['error' => 'Api.companies.invalid.name']);
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
            'photo' => 'http://local.com/photo',
        ];

        $result = $this->withBody(json_encode($payload), 'application/json')
            ->put("{$this->route}/1");

        $result->assertStatus(Response::HTTP_BAD_REQUEST);
        $result->assertJSONFragment(['error' => 'Api.companies.invalid.phone']);
    }

    /**
     * Cenário: strings com tamanho excessivo devem falhar
     */
    public function testInvalidinscribed_atLimit()
    {
        $this->createAuthenticatedSession(1);
        $longString = str_repeat('A', 200);

        $payload = [
            'name' => "AAA",
            'phone' => '5521865954784',
            'inscribed_at' => $longString,
            'photo' => 'http://local.com/photo',
            'status' => 'ACTIVE',
        ];

        $result = $this->withBody(json_encode($payload), 'application/json')
            ->put("{$this->route}/1");

        $result->assertStatus(Response::HTTP_BAD_REQUEST);
        $result->assertJSONFragment(['error' => 'Api.companies.invalid.inscribed_at']);
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
            'inscribed_at' => "1990-10-10",
            'photo' => 'http://local.com/photo',
            'status' => 'ACTIVE',
            'email' => $longString
        ];

        $result = $this->withBody(json_encode($payload), 'application/json')
            ->put("{$this->route}/1");

        $result->assertStatus(Response::HTTP_BAD_REQUEST);
        $result->assertJSONFragment(['error' => 'Api.companies.invalid.email']);
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
            'inscribed_at' => "1990-10-10",
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
        $result->assertJSONFragment(['error' => 'Api.companies.invalid.document']);
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
            'inscribed_at' => "1990-10-10",
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
        $result->assertJSONFragment(['error' => 'Api.companies.invalid.document_type']);
    }

    /**
     * Cenário: strings com tamanho excessivo devem falhar
     */
    public function testInvalidStatusType()
    {
        $this->createAuthenticatedSession(1);

        $payload = [
            'name' => "Bianca",
            'inscribed_at' => "1990-10-10",
            'photo' => 'http://local.com/photo',
            'status' => 'none',
            'email' => 'bianca@gmail.com',
            'document' => '17222534792',
            'document_type' => "CPF"
        ];

        $result = $this->withBody(json_encode($payload), 'application/json')
            ->put("{$this->route}/1");

        $result->assertStatus(Response::HTTP_BAD_REQUEST);
        $result->assertJSONFragment(['error' => 'Api.companies.invalid.status']);
    }
}
