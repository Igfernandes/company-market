<?php

namespace Tests\Support\Libraries\PagSeguro;

use App\Libraries\PagSeguro\Entities\Address;
use App\Libraries\PagSeguro\Entities\Amount;
use App\Libraries\PagSeguro\Entities\Boleto;
use App\Libraries\PagSeguro\Entities\Charges;
use App\Libraries\PagSeguro\Entities\Enums\Address as EnumsAddress;
use App\Libraries\PagSeguro\Entities\PaymentMethod;
use App\Libraries\PagSeguro\PagSeguro;
use CodeIgniter\Test\CIUnitTestCase;

/**
 * @test
 */

// class ChargesTest extends CIUnitTestCase{
    
//     public function CreatePaymentBoleto(){
        
//         $pagSeguro = new PagSeguro();
//         $charges = new Charges();
//         $amount = new Amount();
//         $address = new EnumsAddress();

//         $address->street = 'Rua 43';
//         $address->number = Null;
//         $address->locality = 'Jardim Atlântico Central';
//         $address->city = 'Maricá';
//         $address->region = 'Rio de Janeiro';
//         $address->region_code = 'RJ';
//         $address->country = 'Brasil';
//         $address->postal_code = '24934555';

//         $boleto = new Boleto((Object)[
//             'name' => 'Test',
//             'tax_id' => Null,
//             'email' => 'companymarketbr@gmail.com',
//             'address' => $address
//         ]);
//         $paymentMethod = new PaymentMethod('BOLETO', $boleto);

//         $amount->setValue(10.0);
//         $amount->setCurrency("BRL");
//         $charges->setReferenceId(0001);
//         $charges->setDescription("Apenas um teste unitário");
//         $charges->setAmount($amount);
//         $charges->setPaymentMethod($paymentMethod);

//         $respPayment = $pagSeguro->charges($charges, 'SANDBOX');

//         $this->assertEquals("ex-0001", $respPayment->reference_id);
//     }
// }