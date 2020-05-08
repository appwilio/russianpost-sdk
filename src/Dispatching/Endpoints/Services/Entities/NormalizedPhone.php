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

use Appwilio\RussianPostSDK\Dispatching\DataAware;
use Appwilio\RussianPostSDK\Dispatching\Enum\PhoneQuality;

final class NormalizedPhone
{
    use DataAware;

    public function getId(): string
    {
        return $this->get('id');
    }

    public function getCountryCode(): string
    {
        return $this->get('phone-country-code');
    }

    public function getCityCode(): string
    {
        return $this->get('phone-city-code');
    }

    public function getNumber(): string
    {
        return $this->get('phone-number');
    }

    public function getExtension(): string
    {
        return $this->get('phone-extension');
    }

    public function getOriginalPhone(): string
    {
        return $this->get('original-phone');
    }

    public function getQualityCode(): PhoneQuality
    {
        return new PhoneQuality($this->get('quality-code'));
    }

    public function isUseful(): bool
    {
        return
            $this->getQualityCode()->equals(PhoneQuality::CONFIRMED_MANUALLY())
            ||
            \strpos($this->getQualityCode()->getValue(), PhoneQuality::GOOD()->getValue()) === 0;
    }
}
