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

class TicketResponse
{
    /** @var string */
    public $value;

    /** @var Error */
    public $error;

    public function getId(): string
    {
        return $this->value;
    }

    public function hasError(): bool
    {
        return (bool) $this->error;
    }

    public function getError(): ?Error
    {
        if (! $this->hasError()) {
            return null;
        }

        return $this->error;
    }
}
