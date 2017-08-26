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

namespace Appwilio\RussianPostSDK\Tracking\Single;

class OperationParameters
{
    /** @var Parameter */
    public $OperType;

    /** @var Parameter */
    public $OperAttr;

    /** @var \DateTimeImmutable */
    public $OperDate;

    public function getOperationId(): int
    {
        return $this->OperType->Id;
    }

    public function getAttributeId(): int
    {
        return $this->OperAttr->Id;
    }

    public function getPerformedAt(): \DateTimeImmutable
    {
        return \DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.uP', $this->OperDate);
    }
}
