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

class Value
{
    /** @var Event[]|Event */
    public $Item = [];

    /**
     * @return Event[]
     */
    public function getEvents()
    {
        return $this->Item instanceof Event ? [$this->Item] : $this->Item;
    }
}
