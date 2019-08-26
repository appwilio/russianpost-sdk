<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Settings\Responses;

use JMS\Serializer\Annotation AS JMS;

final class ShippingPoint
{
    /**
     * @JMS\Type("bool")
     * @var bool
     */
    private $enabled;

    /**
     * @JMS\SerializedName("ops-address")
     * @JMS\Type("string")
     * @var string
     */
    private $address;

    /**
     * @JMS\SerializedName("operator-postcode")
     * @JMS\Type("string")
     * @var string
     */
    private $postalCode;

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }
}
