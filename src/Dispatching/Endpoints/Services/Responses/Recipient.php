<?php

declare(strict_types = 1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses;

final class Recipient
{
    public const FRAUD = 'fraud';
    public const RELIABLE = 'reliable';

    /**
     * @JMS\Type("string")
     * @JMS\SerializedName("raw-address")
     */
    public $address;

    /**
     * @JMS\Type("string")
     * @JMS\SerializedName("raw-telephone")
     */
    public $phone;

    /**
     * @JMS\Type("string")
     * @JMS\SerializedName("full-name")
     */
    public $fullName;

    /**
     * @JMS\Type("string")
     * @JMS\SerializedName("unreliability")
     */
    public $unreliability;

    public function isFraud(): bool
    {
        return $this->unreliability === self::FRAUD;
    }

    public function isReliable(): bool
    {
        return $this->unreliability === self::RELIABLE;
    }
}
