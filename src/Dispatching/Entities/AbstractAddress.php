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

namespace Appwilio\RussianPostSDK\Dispatching\Entities;

use Appwilio\RussianPostSDK\Dispatching\DataAware;

abstract class AbstractAddress
{
    use DataAware;

    public function getIndex(): ?string
    {
        return $this->get('index');
    }

    public function getArea(): ?string
    {
        return $this->get('area');
    }

    public function getPlace(): ?string
    {
        return $this->get('place');
    }

    public function getRegion(): ?string
    {
        return $this->get('region');
    }

    public function getLocation(): ?string
    {
        return $this->get('location');
    }

    public function getStreet(): ?string
    {
        return $this->get('street');
    }

    public function getHouse(): ?string
    {
        return $this->get('house');
    }

    public function getRoom(): ?string
    {
        return $this->get('room');
    }

    public function getSlash(): ?string
    {
        return $this->get('slash');
    }

    public function getBuilding(): ?string
    {
        return $this->get('building');
    }

    public function getCorpus(): ?string
    {
        return $this->get('corpus');
    }

    public function getLetter(): ?string
    {
        return $this->get('letter');
    }

    public function getHotel(): ?string
    {
        return $this->get('hotel');
    }

    public function getNumAddressType(): ?string
    {
        return $this->get('num-address-type');
    }
}
