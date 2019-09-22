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
use Appwilio\RussianPostSDK\Tracking\Single\TrackingEventAddress;
use Appwilio\RussianPostSDK\Tracking\Single\TrackingEventCountry;
use Appwilio\RussianPostSDK\Tracking\Single\TrackingEventAddressParameters;

class TrackingEventAddressParametersTest extends TestCase
{
    public function test_getters(): void
    {
        /** @var TrackingEventAddressParameters $parameters */
        $parameters = $this->buildClass(TrackingEventAddressParameters::class, [
            'DestinationAddress' => $this->buildClass(TrackingEventAddress::class),
            'OperationAddress'   => $this->buildClass(TrackingEventAddress::class),
            'MailDirect'         => $this->buildClass(TrackingEventCountry::class),
            'CountryOper'        => $this->buildClass(TrackingEventCountry::class),
            'CountryFrom'        => $this->buildClass(TrackingEventCountry::class),
        ]);

        $this->assertInstanceOf(TrackingEventCountry::class, $parameters->getOperationCountry());
        $this->assertInstanceOf(TrackingEventCountry::class, $parameters->getDepartureCountry());
        $this->assertInstanceOf(TrackingEventCountry::class, $parameters->getDestinationCountry());
        $this->assertInstanceOf(TrackingEventAddress::class, $parameters->getOperationAddress());
        $this->assertInstanceOf(TrackingEventAddress::class, $parameters->getDestinationAddress());
    }
}
