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

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\PostOffices\Responses;

use Appwilio\RussianPostSDK\Dispatching\DataAware;
use Appwilio\RussianPostSDK\Dispatching\Contracts\Arrayable;

final class Phone implements Arrayable
{
    use DataAware;

    public function isFax(): bool
    {
        return $this->get('is-fax');
    }

    public function getNumber(): string
    {
        return $this->get('phone-number');
    }

    public function getTownCode(): ?string
    {
        return $this->get('phone-town-code');
    }

    public function getType(): ?string
    {
        return $this->get('phone-type-name');
    }
}
