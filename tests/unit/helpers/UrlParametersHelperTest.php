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

    /**
     * @method testReturnOfParamStringWithEmptyArray 
     * - Testa o retorno da string de parâmetros com um array vazio.
     */
    public function testReturnOfParamStringWithEmptyArray()
    {
        helper('url_parameters');

        $stringUrlParam = convertUrlParameters([]);

        $this->assertEquals("", $stringUrlParam);
    }

    /**
     * @method testReturnOfStringWithSeparatorDifferent 
     * - Testa o retorno da string de parâmetros com separador diferente.
     */
    public function testReturnOfStringWithSeparatorDifferent()
    {
        helper('url_parameters');

        $stringUrlParam = convertUrlParameters([
            "success" => "Words.message.success_update",
            "customized" => "customized"
        ], [], ["separator" => '+',  "assigner" => '=']);

        $this->assertEquals("success=Words.message.success_update+customized=customized", $stringUrlParam);
    }

    /**
     * @method testReturnOfStringWithAssignerDifferent 
     * - Testa o retorno da string de parâmetros com atribuidor diferente.
     */
    public function testReturnOfStringWithAssignerDifferent()
    {
        helper('url_parameters');

        $stringUrlParam = convertUrlParameters([
            "success" => "Words.message.success_update",
            "customized" => "customized"
        ], [], ["separator" => '&',  "assigner" => ':']);

        $this->assertEquals("success:Words.message.success_update&customized:customized", $stringUrlParam);
    }


    /**
     * @method testReturnOfStringWithParamIgnored 
     * - Testa o retorno da string de parâmetros com parâmetros ignorados.
     */
    public function testReturnOfStringWithParamIgnored()
    {
        helper('url_parameters');

        $stringUrlParam = convertUrlParameters([
            "success" => "Words.message.success_update",
            "customized" => "customized"
        ], ["customized"]);

        $this->assertEquals("success=Words.message.success_update", $stringUrlParam);
    }
}
