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

class Error
{
    /** @var int */
    public $ErrorTypeID;

    /** @var string */
    public $ErrorName;

    public function getCode(): int
    {
        return (int) $this->ErrorTypeID;
    }

    public function getMessage(): string
    {
        return $this->ErrorName;
    }
}
