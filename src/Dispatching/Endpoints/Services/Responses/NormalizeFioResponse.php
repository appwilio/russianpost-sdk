<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses;

use JMS\Serializer\Annotation AS JMS;
use Appwilio\RussianPostSDK\Dispatching\Http\IterableResponse;

final class NormalizeFioResponse extends IterableResponse
{
    /**
     * @JMS\Type("array<Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses\Fio>")
     * @JMS\SerializedName("body")
     */
    private $items = [];

    /**
     * @return iterable|Fio[]
     */
    public function getItems(): iterable
    {
        return $this->items;
    }
}
