<?php

declare(strict_types = 1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Settings\Responses;

use JMS\Serializer\Annotation AS JMS;
use Appwilio\RussianPostSDK\Dispatching\Http\IterableResponse;

final class ShippingPointsResponse extends IterableResponse
{
    /**
     * @JMS\Type("array<Appwilio\RussianPostSDK\Dispatching\Endpoints\Settings\Responses\ShippingPoints>")
     * @JMS\SerializedName("items")
     */
    protected $items = [];

    public function getItems()
    {
        return $this->items;
    }
}
