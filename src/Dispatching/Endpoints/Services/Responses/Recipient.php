<?php

declare(strict_types = 1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses;

use JMS\Serializer\Annotation AS JMS;

final class Recipient
{
    public const FRAUD = 'fraud';
    public const RELIABLE = 'reliable';

    /**
     * @JMS\SerializedName("raw-address")
     * @JMS\Type("string")
     * @var string
     */
    private $address;

    /**
     * @JMS\SerializedName("raw-telephone")
     * @JMS\Type("string")
     * @var string
     */
    private $phone;

    /**
     * @JMS\SerializedName("raw-full-name")
     * @JMS\Type("string")
     * @var string
     */
    private $fullName;

    /**
     * @JMS\SerializedName("unreliability")
     * @JMS\Type("string")
     * @var bool
     */
    private $result;

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function isResult(): bool
    {
        return $this->result;
    }

    public function isFraud(): bool
    {
        return $this->result === self::FRAUD;
    }

    public function isReliable(): bool
    {
        return $this->result === self::RELIABLE;
    }
}
