<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Entities;

use Appwilio\RussianPostSDK\Dispatching\DataAware;
use Appwilio\RussianPostSDK\Dispatching\Contracts\Arrayable;

final class DeliveryTime implements Arrayable
{
    use DataAware;

    public function getMin(): int
    {
        return $this->get('min-days');
    }

    public function getMax(): int
    {
        return $this->get('max-days');
    }
}
