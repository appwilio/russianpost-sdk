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

final class TrackingResponse implements \IteratorAggregate
{
    use ErrorAware;

    /** @var Error|null */
    private $error;

    /** @var ItemsWrapper */
    private $value;

    /**
     * Дата и время формирования билета по MSK (UTC+3).
     *
     * @return \DateTimeImmutable
     */
    public function getPreparedAt(): \DateTimeImmutable
    {
        return $this->value->getPreparedAt();
    }

    /**
     * Список почтовых отправлений.
     *
     * @return Item[]
     */
    public function getItems()
    {
        return $this->value->getItems();
    }

    public function getIterator()
    {
        return (function () {
            foreach ($this->getItems() as $item) {
                yield $item;
            }
        })();
    }
}
