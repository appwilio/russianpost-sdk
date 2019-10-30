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

trait TimeIntervalAware
{
    public function getBegin(): ?string
    {
        return $this->humanizeTime($this->getBeginValue());
    }

    public function getEnd(): ?string
    {
        return $this->humanizeTime($this->getEndValue());
    }

    private function humanizeTime(?string $time): ?string
    {
        if ($time === null) {
            return null;
        }

        $parts = \explode(':', $time);

        return "{$parts[0]}:{$parts[1]}";
    }
}
