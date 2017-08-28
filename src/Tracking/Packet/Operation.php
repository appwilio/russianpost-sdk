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

class Operation
{
    /** @var string */
    public $DateOper;

    /** @var string */
    public $OperName;

    /** @var string */
    public $IndexOper;

    /** @var int */
    public $OperCtgID;

    /** @var int */
    public $OperTypeID;

    public function getOperationName(): string
    {
        return $this->OperName;
    }

    public function getOperationId(): int
    {
        return (int) $this->OperTypeID;
    }

    public function getAttributeId(): int
    {
        return (int) $this->OperCtgID;
    }

    public function getPerformedAt(): \DateTimeImmutable
    {
        return \DateTimeImmutable::createFromFormat('d.m.Y H:i:s', $this->DateOper);
    }

    public function getPostalCode(): string
    {
        return $this->IndexOper;
    }
}
