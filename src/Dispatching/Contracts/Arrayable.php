<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Contracts;

interface Arrayable
{
    public function toArray(): array;
}
