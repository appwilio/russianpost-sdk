<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Entities;

use Appwilio\RussianPostSDK\Dispatching\DataAware;

final class DeliveryTime
{
    use DataAware;

    public function getMin(): ?int
    {
        return $this->get('min-days');
    }

    public function getMax(): int
    {
        return $this->get('max-days');
    }
}
