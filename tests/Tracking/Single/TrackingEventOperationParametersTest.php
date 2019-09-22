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
use Appwilio\RussianPostSDK\Tracking\Single\TrackingEventOperationParameters;

class TrackingEventOperationParametersTest extends TestCase
{
    public function test_getters(): void
    {
        /** @var TrackingEventOperationParameters $parameters */
        $parameters = $this->buildClass(TrackingEventOperationParameters::class, [
            'OperType' => $this->buildClass(Parameter::class, [
                'Id'   => ($operId = 1),
                'Name' => ($operName = 'Прием'),
            ]),
            'OperAttr' => $this->buildClass(Parameter::class, [
                'Id'   => ($attrId = 2),
                'Name' => ($attrName = 'Партионный'),
            ]),
            'OperDate' => ($operDate = '2019-01-01T14:50:00.000+03:00'),
        ]);

        $this->assertEquals($operId, $parameters->getOperationId());
        $this->assertEquals($operName, $parameters->getOperationName());

        $this->assertEquals($attrId, $parameters->getAttributeId());
        $this->assertEquals($attrName, $parameters->getAttributeName());

        $this->assertEquals($operDate, $parameters->getPerformedAt()->format(\DATE_RFC3339_EXTENDED));
    }
}
