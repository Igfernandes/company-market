<?php

namespace Tests\Support\Sessions;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Session\SessionInterface;
use Config\Services;

class BaseSessionTests extends CIUnitTestCase
{
    /** @var SessionInterface|\PHPUnit\Framework\MockObject\MockObject */
    protected $session;

    protected function setUp(): void
    {
        parent::setUp();

        // Cria um mock de sessão
        $this->session = $this->createMock(SessionInterface::class);

        // Injeta no serviço global
        Services::injectMock('session', $this->session);
    }

    protected function setSession(array $data)
    {
        foreach ($data as $key => $value) {
            $this->session->expects($this->any())
                ->method('set')
                ->with($key, $value);
        }
    }

    protected function clearSession()
    {
        $this->session = $this->createMock(SessionInterface::class);
        Services::injectMock('session', $this->session);
    }
}
