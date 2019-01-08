<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses;

use JMS\Serializer\Annotation AS JMS;

final class NormalizeFioResponse
{
    /**
     * @JMS\Type("array<Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses\Fio>")
     * @JMS\SerializedName("body")
     */
    public $items = [];
}
