<?php

/**
 * This file is part of RussianPost SDK package.
 *
 * © Appwilio (http://appwilio.com), JhaoDa (https://github.com/jhaoda)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Entities;

use Appwilio\RussianPostSDK\Dispatching\DataAware;
use Appwilio\RussianPostSDK\Dispatching\Contracts\Arrayable;

final class Balance implements Arrayable
{
    use DataAware;

    public function getValue(): float
    {
        if ($this->get('work-with-balance')) {
            return (float) $this->get('balance');
        }

        throw new \Exception($this->get('error-message'));
    }

    public function getDate(): \DateTimeImmutable
    {
        return \DateTimeImmutable::createFromFormat('Y-m-d', $this->get('balance-date'));
    }
}
