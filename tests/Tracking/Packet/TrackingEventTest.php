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
use Appwilio\RussianPostSDK\Tracking\Packet\TrackingEvent;

class TrackingEventTest extends TestCase
{
    public function test_getters(): void
    {
        /** @var TrackingEvent $event */
        $event = $this->buildClass(TrackingEvent::class, [
            'OperTypeID' => ($operId = 1),
            'OperCtgID'  => ($operCat = 1),
            'OperName'   => ($operName = 'Приём'),
            'DateOper'   => ($operDate = '01.01.2019 01:02:03'),
            'IndexOper'  => ($postalCode = '644008'),
        ]);

        $this->assertEquals($operId, $event->getOperationId());
        $this->assertEquals($operCat, $event->getAttributeId());
        $this->assertEquals($postalCode, $event->getPostalCode());
        $this->assertEquals($operName, $event->getOperationName());
        $this->assertEquals($operDate, $event->getPerformedAt()->format('d.m.Y h:i:s'));
    }
}
