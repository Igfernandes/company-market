<?php

namespace App\Services\MercadoPago\DTOs;


/**
 * Class UserDTO
 *
 * Representa os dados do usuário retornado pela API do Mercado Pago.
 */
class UserDTO
{
    /** @var int */
    public int $id;

    /** @var string */
    public string $nickname;

    /** @var string */
    public string $registration_date;

    /** @var string */
    public string $first_name;

    /** @var string */
    public string $last_name;

    /** @var string */
    public string $gender;

    /** @var string */
    public string $country_id;

    /** @var string */
    public string $email;

    /** @var array */
    public array $identification;

    /** @var array */
    public array $address;

    /** @var array */
    public array $phone;

    /** @var array */
    public array $alternative_phone;

    /** @var string */
    public string $user_type;

    /** @var array */
    public array $tags;

    /** @var mixed */
    public $logo;

    /** @var int */
    public int $points;

    /** @var string */
    public string $site_id;

    /** @var string */
    public string $permalink;

    /** @var string */
    public string $seller_experience;

    /** @var array */
    public array $bill_data;

    /** @var array */
    public array $seller_reputation;

    /** @var array */
    public array $buyer_reputation;

    /** @var array */
    public array $status;

    /** @var string */
    public string $secure_email;

    /** @var array */
    public array $company;

    /** @var array */
    public array $credit;

    /** @var array */
    public array $context;

    /** @var array */
    public array $registration_identifiers;

    /**
     * Construtor dinâmico.
     *
     * @param array $data Dados para preencher a entidade.
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $index => $value) {
            if (property_exists($this, $index)) {
                $this->$index = $value;
            }
        }
    }
}
