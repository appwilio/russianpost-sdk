<?php

declare(strict_types = 1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses;

use JMS\Serializer\Annotation AS JMS;
use Appwilio\RussianPostSDK\Dispatching\Http\IterableResponse;

final class CheckRecipientResponse extends IterableResponse
{
    /**
     * @JMS\Type("array<Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses\Recipient>")
     * @JMS\SerializedName("body")
     */
    private $items = [];

    /**
     * @return iterable|Recipient[]
     */
    public function getItems(): iterable
    {
        return $this->items;
    }
}
