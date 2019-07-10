<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses;

use JMS\Serializer\Annotation AS JMS;
use Appwilio\RussianPostSDK\Dispatching\Http\IterableResponse;

final class NormalizeAddressResponse extends IterableResponse
{
    /**
     * @JMS\Type("array<Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses\Address>")
     * @JMS\SerializedName("items")
     */
    protected $items = [];

    /**
     * @return iterable|Address[]
     */
    public function getItems()
    {
        return $this->items;
    }
}
