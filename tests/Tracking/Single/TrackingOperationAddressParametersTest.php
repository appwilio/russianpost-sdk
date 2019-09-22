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
use Appwilio\RussianPostSDK\Tracking\Single\TrackingOperationAddress;
use Appwilio\RussianPostSDK\Tracking\Single\TrackingOperationCountry;
use Appwilio\RussianPostSDK\Tracking\Single\TrackingOperationAddressParameters;

class TrackingOperationAddressParametersTest extends TestCase
{
    public function test_getters(): void
    {
        /** @var TrackingOperationAddressParameters $parameters */
        $parameters = $this->buildClass(TrackingOperationAddressParameters::class, [
            'DestinationAddress' => $this->buildClass(TrackingOperationAddress::class),
            'OperationAddress'   => $this->buildClass(TrackingOperationAddress::class),
            'MailDirect'         => $this->buildClass(TrackingOperationCountry::class),
            'CountryOper'        => $this->buildClass(TrackingOperationCountry::class),
            'CountryFrom'        => $this->buildClass(TrackingOperationCountry::class),
        ]);

        $this->assertInstanceOf(TrackingOperationCountry::class, $parameters->getOperationCountry());
        $this->assertInstanceOf(TrackingOperationCountry::class, $parameters->getDepartureCountry());
        $this->assertInstanceOf(TrackingOperationCountry::class, $parameters->getDestinationCountry());
        $this->assertInstanceOf(TrackingOperationAddress::class, $parameters->getOperationAddress());
        $this->assertInstanceOf(TrackingOperationAddress::class, $parameters->getDestinationAddress());
    }
}
