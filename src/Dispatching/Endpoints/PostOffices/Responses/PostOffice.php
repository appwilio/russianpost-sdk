<?php

/**
 * This file is part of RussianPost SDK package.
 *
 * © Appwilio (http://appwilio.com), JhaoDa (https://github.com/jhaoda)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\PostOffices\Responses;

use Appwilio\RussianPostSDK\Dispatching\DataAware;
use Appwilio\RussianPostSDK\Dispatching\Instantiator;
use Appwilio\RussianPostSDK\Dispatching\Http\ArrayOf;
use Appwilio\RussianPostSDK\Dispatching\Contracts\Arrayable;

final class PostOffice implements Arrayable
{
    use DataAware;

    public function getAddress(): string
    {
        return $this->get('address-source');
    }

    public function getPostalCode(): string
    {
        return $this->get('postal-code');
    }

    public function isPermanentlyClosed(): bool
    {
        return $this->get('is-closed');
    }

    public function isTemporarilyClosed(): bool
    {
        return $this->get('is-temporary-closed');
    }

    public function getTemporarilyClosedReason(): ?string
    {
        return $this->get('temporary-closed-reason');
    }

    public function getDistrict(): ?string
    {
        return $this->get('district');
    }

    public function getRegion(): ?string
    {
        return $this->get('region');
    }

    public function getSettlement(): ?string
    {
        return $this->get('settlement');
    }

    public function getTypeId(): int
    {
        return $this->get('type-id');
    }

    public function getTypeCode(): string
    {
        return $this->get('type-code');
    }

    public function getUfpsCode(): ?string
    {
        return $this->get('ufps-code');
    }

    public function hasNearestPostOffice(): bool
    {
        return isset($this->data['nearest-post-office']);
    }

    public function getNearestPostOffice(): ?self
    {
        return Instantiator::instantiate(self::class, $this->get('nearest-post-office'));
    }

    /**
     * @return Phone[]|null
     */
    public function getPhones()
    {
        return Instantiator::instantiate(new ArrayOf(Phone::class), $this->get('phones'));
    }

    /**
     * @return WorkingHours[]|null
     */
    public function getWorkingHours()
    {
        return Instantiator::instantiate(new ArrayOf(WorkingHours::class), $this->get('working-hours'));
    }

    /**
     * @return WorkingHours[]|null
     */
    public function getCurrentDayWorkingHours()
    {
        return Instantiator::instantiate(new ArrayOf(WorkingHours::class), $this->get('current-day-working-hours'));
    }

    /**
     * @return WorkingHours[]|null
     */
    public function getNextDayWorkingHours()
    {
        return Instantiator::instantiate(new ArrayOf(WorkingHours::class), $this->get('next-day-working-hours'));
    }

    public function getCoordinates(): Coordinates
    {
        return new Coordinates($this->get('latitude'), $this->get('longitude'));
    }

    /**
     * @return Service[]|null
     */
    public function getServices()
    {
        return Instantiator::instantiate(new ArrayOf(Service::class), $this->get('service-groups'));
    }
}
