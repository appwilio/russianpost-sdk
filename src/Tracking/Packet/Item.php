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

final class Item implements \IteratorAggregate
{
    use ErrorAware;

    /** @var Error|null */
    private $Error;

    /** @var string */
    private $Barcode;

    /** @var TrackingEvent[] */
    private $Operation;

    /**
     * Список событий обработки почтового отправления.
     *
     * @return TrackingEvent[]
     */
    public function getEvents()
    {
        return $this->Operation;
    }

    /**
     * Идентификатор (ШПИ) почтового отправления (Barcode).
     *
     * @return string
     */
    public function getBarcode(): string
    {
        return $this->Barcode;
    }

    public function getIterator()
    {
        return (function () {
            foreach ($this->getEvents() as $event) {
                yield $event;
            }
        })();
    }
}
