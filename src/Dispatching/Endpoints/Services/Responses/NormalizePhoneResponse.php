<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses;

use JMS\Serializer\Annotation AS JMS;
use Appwilio\RussianPostSDK\Dispatching\Http\IterableResponse;

final class NormalizePhoneResponse extends IterableResponse
{
    /**
     * @JMS\Type("array<Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses\Phone>")
     * @JMS\SerializedName("body")
     */
    private $items = [];

    /**
     * @return iterable|Phone[]
     */
    public function getItems(): iterable
    {
        return $this->items;
    }
}
