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

class TrackingResponse
{
    use ErrorAware;

    /** @var Value */
    public $value;

    /** @var Error */
    public $error;

    public function getValue(): Value
    {
        return $this->value;
    }

    /**
     * @return Event[]
     */
    public function getEvents()
    {
        return $this->getValue()->getEvents();
    }
}
