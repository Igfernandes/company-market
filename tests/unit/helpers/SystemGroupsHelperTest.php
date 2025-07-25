<?php

use CodeIgniter\Test\CIUnitTestCase;

/**
 * @internal
 */
final class HealthTest extends CIUnitTestCase
{

    /**
     * @method testReturnOfParamString 
     * - Testa o retorno da string de parâmetros.
     */
    public function testReturnOfParamString()
    {
        helper('url_parameters');

        $stringUrlParam = convertUrlParameters([
            "success" => "Words.message.success_update",
            "customized" => "customized"
        ]);

        $this->assertEquals("success=Words.message.success_update&customized=customized", $stringUrlParam);
    }

}
