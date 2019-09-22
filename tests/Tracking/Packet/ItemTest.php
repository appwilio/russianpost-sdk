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

namespace Appwilio\RussianPostSDK\Tests\Tracking\Packet;

use Appwilio\RussianPostSDK\Tests\TestCase;
use Appwilio\RussianPostSDK\Tracking\Packet\Item;
use Appwilio\RussianPostSDK\Tracking\Packet\TrackingEvent;

class ItemTest extends TestCase
{
    public function test_getters(): void
    {
        /** @var Item $item */
        $item = $this->buildClass(Item::class, [
            'Barcode'   => ($barcode = 'RA644000001RU'),
            'Operation' => [
                $this->buildClass(TrackingEvent::class),
                $this->buildClass(TrackingEvent::class),
            ],
        ]);

        $this->assertEquals($barcode, $item->getBarcode());

        $this->assertInstanceOf(\Traversable::class, $item->getIterator());

        foreach ($item as $operation) {
            $this->assertInstanceOf(TrackingEvent::class, $operation);
        }
    }
}
