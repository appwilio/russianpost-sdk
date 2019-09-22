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

namespace Appwilio\RussianPostSDK\Tests\Tracking\Single;

use Appwilio\RussianPostSDK\Tests\TestCase;
use Appwilio\RussianPostSDK\Tracking\Single\TrackingEvent;
use Appwilio\RussianPostSDK\Tracking\Single\TrackingEventItemParameters;
use Appwilio\RussianPostSDK\Tracking\Single\TrackingEventUserParameters;
use Appwilio\RussianPostSDK\Tracking\Single\TrackingEventAddressParameters;
use Appwilio\RussianPostSDK\Tracking\Single\TrackingEventFinanceParameters;
use Appwilio\RussianPostSDK\Tracking\Single\TrackingEventOperationParameters;

class TrackingEventTest extends TestCase
{
    public function test_getters(): void
    {
        /** @var TrackingEvent $event */
        $event = $this->buildClass(TrackingEvent::class, [
            'AddressParameters'   => $this->buildClass(TrackingEventAddressParameters::class),
            'FinanceParameters'   => $this->buildClass(TrackingEventFinanceParameters::class),
            'ItemParameters'      => $this->buildClass(TrackingEventItemParameters::class),
            'OperationParameters' => $this->buildClass(TrackingEventOperationParameters::class),
            'UserParameters'      => $this->buildClass(TrackingEventUserParameters::class),
        ]);

        $this->assertInstanceOf(TrackingEventItemParameters::class, $event->getItemParameters());
        $this->assertInstanceOf(TrackingEventUserParameters::class, $event->getUserParameters());
        $this->assertInstanceOf(TrackingEventOperationParameters::class, $event->getOperationParameters());
        $this->assertInstanceOf(TrackingEventAddressParameters::class, $event->getAddressParameters());
        $this->assertInstanceOf(TrackingEventFinanceParameters::class, $event->getFinanceParameters());
    }
}
