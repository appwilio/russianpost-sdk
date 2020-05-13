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

namespace Appwilio\RussianPostSDK\Tests\Dispatching\Endpoints\Services\Entities;

use Appwilio\RussianPostSDK\Tests\TestCase;
use Appwilio\RussianPostSDK\Dispatching\Instantiator;
use Appwilio\RussianPostSDK\Dispatching\Enum\PhoneQuality;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Entities\NormalizedPhone;

class NormalizedPhoneTest extends TestCase
{
    public function test_can_get_data(): void
    {
        /** @var NormalizedPhone $instance */
        $instance = Instantiator::instantiate(NormalizedPhone::class, [
            'id'                 => ($id = \md5('123')),
            'phone-country-code' => ($countryCode = '7'),
            'phone-city-code'    => ($cityCode = '901'),
            'phone-number'       => ($number = '2345678'),
            'phone-extension'    => ($extension = ''),
            'original-phone'     => ($original = '79012345678'),
            'quality-code'       => ($quality = PhoneQuality::GOOD()->getValue()),
        ]);

        $this->assertEquals($id, $instance->getId());
        $this->assertEquals($countryCode, $instance->getCountryCode());
        $this->assertEquals($number, $instance->getNumber());
        $this->assertEquals($extension, $instance->getExtension());
        $this->assertEquals($cityCode, $instance->getCityCode());
        $this->assertEquals($original, $instance->getOriginalPhone());
        $this->assertEquals(new PhoneQuality($quality), $instance->getQualityCode());
        $this->assertEquals(true, $instance->isUseful());
    }
}
