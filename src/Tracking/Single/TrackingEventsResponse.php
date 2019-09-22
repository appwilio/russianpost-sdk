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

final class TrackingEventsResponse implements \IteratorAggregate
{
    /** @var TrackingEventsWrapper */
    private $OperationHistoryData;

    /**
     * Список операций над почтовым отправлением.
     *
     * @return TrackingEvent[]
     */
    public function getOperations()
    {
        return $this->OperationHistoryData->getOperations();
    }

    public function getIterator()
    {
        return (function () {
            foreach ($this->getOperations() as $operation) {
                yield $operation;
            }
        })();
    }
}
