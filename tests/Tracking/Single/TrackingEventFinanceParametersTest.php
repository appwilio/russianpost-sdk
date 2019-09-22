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
use Appwilio\RussianPostSDK\Tracking\Single\TrackingEventFinanceParameters;

class TrackingEventFinanceParametersTest extends TestCase
{
    public function test_getters(): void
    {
        /** @var TrackingEventFinanceParameters $parameters */
        $parameters = $this->buildClass(TrackingEventFinanceParameters::class, [
            'Payment'    => 1000 * 100,
            'Value'      => 800 * 100,
            'MassRate'   => 100 * 100,
            'InsrRate'   => 50 * 100,
            'AirRate'    => 0,
            'Rate'       => 0,
            'CustomDuty' => 0,
        ]);

        $this->assertEquals(0, $parameters->getAirRate());
        $this->assertEquals(0, $parameters->getExtraRate());
        $this->assertEquals(0, $parameters->getCustomsDuty());
        $this->assertEquals(1000 * 100, $parameters->getPayment());
        $this->assertEquals(100 * 100, $parameters->getWeightRate());
        $this->assertEquals(50 * 100, $parameters->getInsuranceRate());
        $this->assertEquals(800 * 100, $parameters->getDeclaredValue());
    }
}
