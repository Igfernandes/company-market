<?php

namespace Tests\Feature\Companies\Post;

use CodeIgniter\HTTP\Response;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Mocks\Companies\CompaniesMock;
use Tests\Support\Sessions\AuthenticatedSession;

class PostFailedTest extends CompaniesMock
{
    use FeatureTestTrait, AuthenticatedSession;

    private string $route = '/api/companies';


    public function testMissingRequiredName()
    {
        $this->createAuthenticatedSession(1);
        $payload = [
            // faltando: name, type, manufacturer, model
            'status' => 'AVAILABLE',
        ];

        $result = $this->withBody(json_encode($payload), 'application/json')
            ->post($this->route);

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
            ->post($this->route);

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
            'photo' => 'http://local.com/photo',
        ];

        $result = $this->withBody(json_encode($payload), 'application/json')
            ->post($this->route);

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
            'birthdate' =>  '1995-25-12',
            'photo' => 'http://local.com/photo',
        ];

        $result = $this->withBody(json_encode($payload), 'application/json')
            ->post($this->route);

        $result->assertStatus(Response::HTTP_BAD_REQUEST);
        $result->assertJSONFragment(['error' => 'Api.companies.invalid.phone']);
    }

    /**
     * Cenário: strings com tamanho excessivo devem falhar
     */
    public function testInvalidInscirbedAtLimit()
    {
        $this->createAuthenticatedSession(1);
        $longString = str_repeat('A', 200);

        $payload = [
            'name' => "AAA",
            'inscribed_at' => $longString,
            'phone' => '21589101515',
            'photo' => 'http://local.com/photo',
            'status' => 'ACTIVE',
        ];

        $result = $this->withBody(json_encode($payload), 'application/json')
            ->post($this->route);

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
            'phone' => '21589101515',
            'birthdate' => "1990-10-10",
            'photo' => 'http://local.com/photo',
            'status' => 'ACTIVE',
            'email' => $longString
        ];

        $result = $this->withBody(json_encode($payload), 'application/json')
            ->post($this->route);

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
            'birthdate' => "1990-10-10",
            'phone' => '21589101515',
            'photo' => 'http://local.com/photo',
            'status' => 'ACTIVE',
            'email' => 'bianca@gmail.com',
            'document' => $longString
        ];

        $result = $this->withBody(json_encode($payload), 'application/json')
            ->post($this->route);

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
            'phone' => '2195748115',
            'birthdate' => "1990-10-10",
            'photo' => 'http://local.com/photo',
            'status' => 'ACTIVE',
            'email' => 'bianca@gmail.com',
            'document' => '17222534792',
            'document_type' => $longString
        ];

        $result = $this->withBody(json_encode($payload), 'application/json')
            ->post($this->route);

        $result->assertStatus(Response::HTTP_BAD_REQUEST);
        $result->assertJSONFragment(['error' => 'Api.companies.invalid.document_type']);
    }

    /**
     * Cenário: strings com tamanho excessivo devem falhar
     */
    public function testInvalidStatusType()
    {
        $this->createAuthenticatedSession(1);
        $longString = str_repeat('A', 200);

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
            ->post($this->route);

        $result->assertStatus(Response::HTTP_BAD_REQUEST);
        $result->assertJSONFragment(['error' => 'Api.companies.invalid.status']);
    }
}
