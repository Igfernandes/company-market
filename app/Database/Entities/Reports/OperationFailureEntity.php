<?php

namespace App\Database\Entities\Reports;

use App\Traits\EntityEnhancerTrait;
use CodeIgniter\Entity\Entity;

class OperationFailureEntity extends Entity
{
    use EntityEnhancerTrait;

    protected $dates = [];
    protected $attributes = [
        'id'                 => null,
        'operation_type'     => null,
        'provider'           => null,
        'error_message'      => null,
        'error_code'         => null,
        'payload_sent'       => null,
        'response_received'  => null,
        'attempt_number'     => null,
        'should_retry'       => null,
        'status'             => null,
        'resolved_at'        => null,
        'created_at'         => null,
        'updated_at'         => null,
    ];

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->attributes['id'];
    }

    /**
     * @param int|null $id
     * @return void
     */
    public function setId(?int $id): void
    {
        $this->attributes['id'] = $id;
    }

    /**
     * @return string|null
     */
    public function getOperationType(): ?string
    {
        return $this->attributes['operation_type'];
    }

    /**
     * @param string|null $type
     * @return void
     */
    public function setOperationType(?string $type): void
    {
        $this->attributes['operation_type'] = $type;
    }

    /**
     * @return string|null
     */
    public function getProvider(): ?string
    {
        return $this->attributes['provider'];
    }

    /**
     * @param string|null $provider
     * @return void
     */
    public function setProvider(?string $provider): void
    {
        $this->attributes['provider'] = $provider;
    }

    /**
     * @return string|null
     */
    public function getErrorMessage(): ?string
    {
        return $this->attributes['error_message'];
    }

    /**
     * @param string|null $message
     * @return void
     */
    public function setErrorMessage(?string $message): void
    {
        $this->attributes['error_message'] = $message;
    }

    /**
     * @return int|null
     */
    public function getErrorCode(): string|int|null
    {
        return $this->attributes['error_code'];
    }

    /**
     * @param int|null $code
     * @return void
     */
    public function setErrorCode(?int $code): void
    {
        $this->attributes['error_code'] = $code;
    }

    /**
     * @return string|null JSON
     */
    public function getPayloadSent(): ?string
    {
        return $this->attributes['payload_sent'];
    }

    /**
     * @param string|null $payload JSON
     * @return void
     */
    public function setPayloadSent(?string $payload): void
    {
        $this->attributes['payload_sent'] = $payload;
    }

    /**
     * @return string|null JSON
     */
    public function getResponseReceived(): ?string
    {
        return $this->attributes['response_received'];
    }

    /**
     * @param string|null $response JSON
     * @return void
     */
    public function setResponseReceived(?string $response): void
    {
        $this->attributes['response_received'] = $response;
    }

    /**
     * @return int|null
     */
    public function getAttemptNumber(): ?int
    {
        return $this->attributes['attempt_number'];
    }

    /**
     * @param int|null $number
     * @return void
     */
    public function setAttemptNumber(?int $number): void
    {
        $this->attributes['attempt_number'] = $number;
    }

    /**
     * @return bool|null
     */
    public function getShouldRetry(): ?bool
    {
        return (bool) $this->attributes['should_retry'];
    }

    /**
     * @param bool|null $shouldRetry
     * @return void
     */
    public function setShouldRetry(?bool $shouldRetry): void
    {
        $this->attributes['should_retry'] = $shouldRetry;
    }

    /**
     * @return string|null PENDING|RETRYING|FAILED|RESOLVED
     */
    public function getStatus(): ?string
    {
        return $this->attributes['status'];
    }

    /**
     * @param string|null $status
     * @return void
     */
    public function setStatus(?string $status): void
    {
        $this->attributes['status'] = $status;
    }

    /**
     * @return string|null datetime
     */
    public function getResolvedAt(): ?string
    {
        return $this->attributes['resolved_at'];
    }

    /**
     * @param string|null $resolvedAt datetime
     * @return void
     */
    public function setResolvedAt(?string $resolvedAt): void
    {
        $this->attributes['resolved_at'] = $resolvedAt;
    }

    /**
     * @return string|null datetime
     */
    public function getCreatedAt(): ?string
    {
        return $this->attributes['created_at'];
    }

    /**
     * @param string|null $createdAt datetime
     * @return void
     */
    public function setCreatedAt(?string $createdAt): void
    {
        $this->attributes['created_at'] = $createdAt;
    }

    /**
     * @return string|null datetime
     */
    public function getUpdatedAt(): ?string
    {
        return $this->attributes['updated_at'];
    }

    /**
     * @param string|null $updatedAt datetime
     * @return void
     */
    public function setUpdatedAt(?string $updatedAt): void
    {
        $this->attributes['updated_at'] = $updatedAt;
    }
}
