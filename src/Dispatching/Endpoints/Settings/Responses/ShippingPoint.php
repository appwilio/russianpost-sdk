<?php

declare(strict_types = 1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Settings\Responses;

use JMS\Serializer\Annotation AS JMS;

final class ShippingPoint
{
    /**
     * @JMS\Type("bool")
     * @var bool
     */
    public $enabled;

    /**
     * @JMS\Type("string")
     * @JMS\SerializedName("ops-address")
     * @var string
     */
    public $address;

    /**
     * @JMS\Type("string")
     * @JMS\SerializedName("operator-postcode")
     * @var string
     */
    public $postCode;
}
