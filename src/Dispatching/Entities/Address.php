<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Entities;

use Appwilio\RussianPostSDK\Dispatching\DataAware;
use Appwilio\RussianPostSDK\Dispatching\Instantiator;
use Appwilio\RussianPostSDK\Dispatching\Enum\AddressType;
use Appwilio\RussianPostSDK\Dispatching\Contracts\Arrayable;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Entities\NormalizedAddress;

final class Address implements Arrayable
{
    use DataAware;

    public static function fromNormalizedAddress(NormalizedAddress $address): self
    {
        if ($address->isUnuseful()) {
            throw new \InvalidArgumentException('У нормализованного адреса неприемлемое качество.');
        }

        return Instantiator::instantiateFrom(self::class, $address, [
            'id', 'original-address', 'quality-code', 'validation-code'
        ]);
    }

    public function __construct(?string $addressType = null)
    {
        $this->setType($addressType ?? AddressType::DEFAULT);
    }

    public function setType(string $addressType)
    {
        $this->data['address-type'] = $addressType;

        return $this;
    }

    public function getAddressType(): string
    {
        return $this->get('address-type');
    }

    public function getCountryCode(): ?string
    {
        return $this->get('mail-direct');
    }

    public function setCountryCode(int $countryCode)
    {
        $this->data['mail-direct'] = $countryCode;

        return $this;
    }

    public function getIndex(): ?string
    {
        return $this->get('index');
    }

    public function setIndex(string $index)
    {
        $this->data['index'] = $index;

        return $this;
    }

    public function getArea(): ?string
    {
        return $this->get('area');
    }

    public function setArea(string $area)
    {
        $this->data['area'] = $area;

        return $this;
    }

    public function getPlace(): ?string
    {
        return $this->get('place');
    }

    public function setPlace(string $place)
    {
        $this->data['place'] = $place;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->get('region');
    }

    public function setRegion(string $region)
    {
        $this->data['region'] = $region;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->get('location');
    }

    public function setLocation(string $location)
    {
        $this->data['location'] = $location;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->get('street');
    }

    public function setStreet(string $street)
    {
        $this->data['street'] = $street;

        return $this;
    }

    public function getHouse(): ?string
    {
        return $this->get('house');
    }

    public function setHouse(string $house)
    {
        $this->data['house'] = $house;

        return $this;
    }

    public function getRoom(): ?string
    {
        return $this->get('room');
    }

    public function setRoom(string $room)
    {
        $this->data['room'] = $room;

        return $this;
    }

    public function getSlash(): ?string
    {
        return $this->get('slash');
    }

    public function setSlash(string $slash)
    {
        $this->data['slash'] = $slash;

        return $this;
    }

    public function getBuilding(): ?string
    {
        return $this->get('building');
    }

    public function setBuilding(string $building)
    {
        $this->data['building'] = $building;

        return $this;
    }

    public function getCorpus(): ?string
    {
        return $this->get('corpus');
    }

    public function setCorpus(string $corpus)
    {
        $this->data['corpus'] = $corpus;

        return $this;
    }

    public function getLetter(): ?string
    {
        return $this->get('letter');
    }

    public function setLetter(string $letter)
    {
        $this->data['letter'] = $letter;

        return $this;
    }

    public function getHotel(): ?string
    {
        return $this->get('hotel');
    }

    public function setHotel(string $hotel)
    {
        $this->data['hotel'] = $hotel;

        return $this;
    }

    public function getVladenie(): ?string
    {
        return $this->get('vladenie');
    }

    public function setVladenie(string $vladenie)
    {
        $this->data['vladenie'] = $vladenie;

        return $this;
    }

    public function getNumAddressType(): ?string
    {
        return $this->get('num-address-type');
    }
}
