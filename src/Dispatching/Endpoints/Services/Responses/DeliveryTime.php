<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses;

use JMS\Serializer\Annotation AS JMS;

final class DeliveryTime
{
    /**
     * @JMS\SerializedName("min-days")
     * @JMS\Type("int")
     * @var int
     */
    private $min;

    /**
     * @JMS\SerializedName("max-days")
     * @JMS\Type("int")
     * @var int
     */
    private $max;

    public function getMin(): int
    {
        return $this->min;
    }

    public function getMax(): int
    {
        return $this->max;
    }
}
