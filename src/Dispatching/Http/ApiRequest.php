<?php

declare(strict_types = 1);

namespace Appwilio\RussianPostSDK\Dispatching\Http;

abstract class ApiRequest
{
    abstract public function toArray(): array;
}
