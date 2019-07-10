<?php

declare(strict_types = 1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses;

use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses\Recipient;
use JMS\Serializer\Annotation AS JMS;
use Appwilio\RussianPostSDK\Dispatching\Http\IterableResponse;

final class CheckRecipientResponse extends IterableResponse
{
    /**
     * @JMS\Type("array<Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses\Recipient>")
     * @JMS\SerializedName("items")
     */
    protected $items = [];

    /**
     * @return iterable|Recipient[]
     */
    public function getItems()
    {
        return $this->items;
    }
}
