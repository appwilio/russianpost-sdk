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

final class TrackingEventsWrapper
{
    /** @var TrackingEvent[]|TrackingEvent */
    private $historyRecord;

    /**
     * @return TrackingEvent[]
     */
    public function getEvents()
    {
        if ($this->historyRecord instanceof TrackingEvent) {
            $this->historyRecord = [$this->historyRecord];
        }

        return $this->historyRecord;
    }
}
