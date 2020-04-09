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

final class CheckedRecipient implements Arrayable
{
    use DataAware;

    public const FRAUD = 'fraud';
    public const RELIABLE = 'reliable';

    public function getAddress(): string
    {
        return $this->get('raw-address');
    }

    public function getPhone(): string
    {
        return $this->get('raw-telephone');
    }

    public function getFullName(): string
    {
        return $this->get('raw-full-name');
    }

    public function getResult(): bool
    {
        return $this->get('unreliability');
    }

    public function isFraud(): bool
    {
        return $this->getResult() === self::FRAUD;
    }

    public function isReliable(): bool
    {
        return $this->getResult() === self::RELIABLE;
    }
}
