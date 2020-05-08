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

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Entities;

use Appwilio\RussianPostSDK\Dispatching\Enum\AddressType;
use Appwilio\RussianPostSDK\Dispatching\Enum\AddressQuality;
use Appwilio\RussianPostSDK\Dispatching\Enum\AddressValidity;
use Appwilio\RussianPostSDK\Dispatching\Entities\AbstractAddress;

final class NormalizedAddress extends AbstractAddress
{
    public function getId(): string
    {
        return $this->get('id');
    }

    public function getOriginalAddress(): string
    {
        return $this->get('original-address');
    }

    public function getAddressType(): AddressType
    {
        return new AddressType($this->get('address-type'));
    }

    public function getQualityCode(): AddressQuality
    {
        return new AddressQuality($this->get('quality-code'));
    }

    public function getValidationCode(): AddressValidity
    {
        return new AddressValidity($this->get('validation-code'));
    }

    public function isUseful(): bool
    {
        return
            \in_array($this->getQualityCode(), AddressQuality::ACCEPTABLE_OPTIONS())
            &&
            \in_array($this->getValidationCode(), AddressValidity::ACCEPTABLE_OPTIONS());
    }

    public function isUnuseful(): bool
    {
        return ! $this->isUseful();
    }
}
