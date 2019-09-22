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

final class Error
{
    /** @var int */
    private $ErrorTypeID;

    /** @var string */
    private $ErrorName;

    /**
     * Идентификатор ошибки (ErrorTypeID).
     *
     * @return int
     */
    public function getCode(): int
    {
        return $this->ErrorTypeID;
    }

    /**
     * Текст ошибки (ErrorName).
     *
     * @return string
     */
    public function getMessage(): string
    {
        return $this->ErrorName;
    }
}
