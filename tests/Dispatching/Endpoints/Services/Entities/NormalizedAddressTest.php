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
use Appwilio\RussianPostSDK\Dispatching\Enum\AddressType;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Entities\NormalizedAddress;

class NormalizedAddressTest extends TestCase
{
    public function test_can_get_data(): void
    {
        /** @var NormalizedAddress $instance */
        $instance = Instantiator::instantiate(NormalizedAddress::class, [
            'id'               => ($id = \md5('123')),
            'index'            => ($index = '123456'),
            'area'             => ($area = 'р-н Симпсоновский'),
            'place'            => ($place = 'г Футурама'),
            'region'           => ($region = 'обл Московская'),
            'location'         => ($location = ''),
            'street'           => ($street = 'Бендера'),
            'house'            => ($house = '100'),
            'room'             => ($room = '200'),
            'slash'            => ($slash = '/'),
            'building'         => ($building = '1'),
            'corpus'           => ($corpus = '2'),
            'letter'           => ($letter = 'А'),
            'hotel'            => ($hotel = ''),
            'num-address-type' => ($numAddressType = ''),
            'address-type'     => ($addressType = AddressType::DEFAULT),
            'original-address' => ($original = 'Россия, 123456, Московская обл Симпсоновский р-н, Футурама, Бендера, 100а с1 к2, кв.500'),
            'quality-code'     => ($quality = NormalizedAddress::QUALITY_GOOD),
            'validation-code'  => ($validation = NormalizedAddress::VALIDATION_VALIDATED),
        ]);

        $this->assertEquals($id, $instance->getId());
        $this->assertEquals($index, $instance->getIndex());
        $this->assertEquals($area, $instance->getArea());
        $this->assertEquals($place, $instance->getPlace());
        $this->assertEquals($region, $instance->getRegion());
        $this->assertEquals($location, $instance->getLocation());
        $this->assertEquals($street, $instance->getStreet());
        $this->assertEquals($house, $instance->getHouse());
        $this->assertEquals($room, $instance->getRoom());
        $this->assertEquals($slash, $instance->getSlash());
        $this->assertEquals($building, $instance->getBuilding());
        $this->assertEquals($corpus, $instance->getCorpus());
        $this->assertEquals($letter, $instance->getLetter());
        $this->assertEquals($hotel, $instance->getHotel());
        $this->assertEquals($numAddressType, $instance->getNumAddressType());
        $this->assertEquals($addressType, $instance->getAddressType());

        $this->assertEquals($original, $instance->getOriginalAddress());
        $this->assertEquals($quality, $instance->getQualityCode());
        $this->assertEquals($validation, $instance->getValidationCode());
    }

    /**
     * @param  string  $qualityCode
     * @param  string  $validationCode
     *
     * @dataProvider addressCodeProvider
     */
    public function test_usefulness(string $qualityCode, string $validationCode): void
    {
        $instance = Instantiator::instantiate(NormalizedAddress::class, [
            'quality-code'    => $qualityCode,
            'validation-code' => $validationCode,
        ]);

        $this->assertEquals(true, $instance->isUseful());
        $this->assertEquals(false, $instance->isUnuseful());
    }

    public function addressCodeProvider(): \Generator
    {
        foreach (NormalizedAddress::ACCEPTABLE_QUALITY as $qCode) {
            foreach (NormalizedAddress::ACCEPTABLE_VALIDITY as $vCode) {
                yield [$qCode, $vCode];
            }
        }
    }
}
