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
use Appwilio\RussianPostSDK\Tracking\Single\TrackingOperationItemParameters;

class TrackingOperationItemParametersTest extends TestCase
{
    public function test_getters(): void
    {
        /** @var TrackingOperationItemParameters $parameters */
        $parameters = $this->buildClass(TrackingOperationItemParameters::class, [
            'Barcode'   => ($barcode = 'RA644000001RU'),
            //'Internum',
            //'ValidRuType',
            //'ValidEnType',
            //'ComplexItemName',
            'MailRank'  => $this->buildClass(Parameter::class),
            'PostMark'  => $this->buildClass(Parameter::class),
            'MailType'  => $this->buildClass(Parameter::class),
            'MailCtg'   => $this->buildClass(Parameter::class),
            'Mass'      => ($weight = 100),
            'MaxMassRu' => ($maxDomWeight = 30 * 1000),
            'MaxMassEn' => ($maxIntWeight = 10 * 1000),
        ]);

        $this->assertInstanceOf(Parameter::class, $parameters->getMailRank());
        $this->assertInstanceOf(Parameter::class, $parameters->getPostMark());
        $this->assertInstanceOf(Parameter::class, $parameters->getMailType());
        $this->assertInstanceOf(Parameter::class, $parameters->getMailCategory());

        $this->assertEquals($barcode, $parameters->getBarcode());
        $this->assertEquals($weight, $parameters->getWeight());
        $this->assertEquals($maxDomWeight, $parameters->getMaxDomesticWeight());
        $this->assertEquals($maxIntWeight, $parameters->getMaxInternationalWeight());
    }
}
