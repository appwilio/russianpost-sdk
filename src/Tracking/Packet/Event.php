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

class Event
{
    use ErrorAware;

    /** @var Error */
    public $Error;

    /** @var string */
    public $Barcode;

    /** @var Operation[] */
    public $Operation;

    /**
     * @return Operation[]
     */
    public function getOperations()
    {
        return $this->Operation;
    }

    public function getBarcode(): string
    {
        return $this->Barcode;
    }

    public function isFound(): bool
    {
        return (bool) count($this->Operation);
    }
}
