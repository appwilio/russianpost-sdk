<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses;

use JMS\Serializer\Annotation AS JMS;

final class NormalizeAddressResponse extends IterableResponse
{
    /**
     * @JMS\Type("array<Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses\Address>")
     * @JMS\SerializedName("body")
     */
    private $items = [];

    /**
     * @return iterable|Address[]
     */
    public function getItems(): iterable
    {
        return $this->items;
    }
}
