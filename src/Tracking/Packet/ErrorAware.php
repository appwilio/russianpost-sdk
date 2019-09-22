<?php

/**
 * This file is part of RussianPost SDK package.
 *
 * © Appwilio (http://appwilio.com), greabock (https://github.com/greabock), JhaoDa (https://github.com/jhaoda)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Tracking\Packet;

trait ErrorAware
{
    /**
     * Ответ с ошибкой?
     *
     * @return bool
     */
    public function hasError(): bool
    {
        return (bool) $this->getError();
    }

    /**
     * Информация об ошибке.
     *
     * @return Error|null
     */
    public function getError(): ?Error
    {
        return $this->error ?? $this->Error ?? null;
    }
}
