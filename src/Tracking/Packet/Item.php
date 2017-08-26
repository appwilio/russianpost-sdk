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

class Item
{
    /** @var Operation[] */
    public $Operation;

    /** @var string */
    public $Barcode;

    /** @var Error */
    public $Error;

    /**
     * @return Operation[]
     */
    public function getOperations()
    {
        return $this->Operation;
    }

    public function getBarcode()
    {
        return $this->Barcode;
    }

    public function isFound(): bool
    {
        return (bool) count($this->Operation);
    }

    public function hasError(): bool
    {
        return (bool) $this->Error;
    }

    public function getError(): ?Error
    {
        if (! $this->hasError()) {
            return null;
        }

        return $this->Error;
    }
}
