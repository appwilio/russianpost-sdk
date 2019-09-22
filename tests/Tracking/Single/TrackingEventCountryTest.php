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
use Appwilio\RussianPostSDK\Tracking\Single\TrackingEventCountry;

class TrackingEventCountryTest extends TestCase
{
    public function test_getters(): void
    {
        /** @var TrackingEventCountry $country */
        $country = $this->buildClass(TrackingEventCountry::class, [
            'Id'     => 643,
            'Code2A' => 'RU',
            'Code3A' => 'RUS',
            'NameRU' => 'РОССИЙСКАЯ ФЕДЕРАЦИЯ',
            'NameEN' => 'RUSSIAN FEDERATION',
        ]);

        $this->assertEquals(643, $country->getId());
        $this->assertEquals('RU', $country->getCode2A());
        $this->assertEquals('RUS', $country->getCode3A());
        $this->assertEquals('RUSSIAN FEDERATION', $country->getNameEN());
        $this->assertEquals('РОССИЙСКАЯ ФЕДЕРАЦИЯ', $country->getNameRU());
    }
}
