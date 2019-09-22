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
use Appwilio\RussianPostSDK\Tracking\Single\Parameter;
use Appwilio\RussianPostSDK\Tracking\Single\TrackingOperationParameters;

class TrackingOperationParametersTest extends TestCase
{
    public function test_getters(): void
    {
        /** @var TrackingOperationParameters $parameters */
        $parameters = $this->buildClass(TrackingOperationParameters::class, [
            'OperType' => $this->buildClass(Parameter::class),
            'OperAttr' => $this->buildClass(Parameter::class),
            'OperDate' => ($operDate = '2019-01-01T14:50:00.000+03:00'),
        ]);

        $this->assertInstanceOf(Parameter::class, $parameters->getOperation());
        $this->assertInstanceOf(Parameter::class, $parameters->getAttribute());
        $this->assertEquals($operDate, $parameters->getPerformedAt()->format(\DATE_RFC3339_EXTENDED));
    }
}
