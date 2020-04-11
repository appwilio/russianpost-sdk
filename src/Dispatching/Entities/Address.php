<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Entities;

use Appwilio\RussianPostSDK\Dispatching\Instantiator;
use Appwilio\RussianPostSDK\Dispatching\Enum\AddressType;
use Appwilio\RussianPostSDK\Dispatching\Contracts\Arrayable;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Entities\NormalizedAddress;

final class Address extends AbstractAddress implements Arrayable
{
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

    public function setIndex(string $index)
    {
        $this->data['index'] = $index;

        return $this;
    }

    public function setArea(string $area)
    {
        $this->data['area'] = $area;

        return $this;
    }

    public function setPlace(string $place)
    {
        $this->data['place'] = $place;

        return $this;
    }

    public function setRegion(string $region)
    {
        $this->data['region'] = $region;

        return $this;
    }

    public function setLocation(string $location)
    {
        $this->data['location'] = $location;

        return $this;
    }

    public function setStreet(string $street)
    {
        $this->data['street'] = $street;

        return $this;
    }

    public function setHouse(string $house)
    {
        $this->data['house'] = $house;

        return $this;
    }

    public function setRoom(string $room)
    {
        $this->data['room'] = $room;

        return $this;
    }

    public function setSlash(string $slash)
    {
        $this->data['slash'] = $slash;

        return $this;
    }

    public function setBuilding(string $building)
    {
        $this->data['building'] = $building;

        return $this;
    }

    public function setCorpus(string $corpus)
    {
        $this->data['corpus'] = $corpus;

        return $this;
    }

    public function setLetter(string $letter)
    {
        $this->data['letter'] = $letter;

        return $this;
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

    public function toArray(): array
    {
        return $this->data;
    }
}
