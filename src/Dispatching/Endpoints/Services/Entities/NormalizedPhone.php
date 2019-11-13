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
use Appwilio\RussianPostSDK\Dispatching\Contracts\Arrayable;

final class NormalizedPhone implements Arrayable
{
    use DataAware;

    /**
     * Коды качества нормализации телефона.
     *
     * @see https://otpravka.pochta.ru/specification#/enums-clean-fio-phone-quality
     */
    public const QUALITY_UNDEF = 'UNDEF';
    public const QUALITY_EMPTY = 'EMPTY';
    public const QUALITY_GARBAGE = 'GARBAGE';
    public const QUALITY_INCORRECT_DATA = 'INCORRECT_DATA';
    public const QUALITY_FOREIGN = 'FOREIGN';
    public const QUALITY_CODE_AMBI = 'CODE_AMBI';
    public const QUALITY_GOOD = 'GOOD';
    public const QUALITY_GOOD_CITY = 'GOOD_CITY';
    public const QUALITY_GOOD_EXTRA_PHONE = 'GOOD_EXTRA_PHONE';
    public const QUALITY_GOOD_REPLACED_CODE = 'GOOD_REPLACED_CODE';
    public const QUALITY_GOOD_REPLACED_NUMBER = 'GOOD_REPLACED_NUMBER';
    public const QUALITY_GOOD_REPLACED_CODE_NUMBER = 'GOOD_REPLACED_CODE_NUMBER';
    public const QUALITY_GOOD_CITY_CONFLICT = 'GOOD_CITY_CONFLICT';
    public const QUALITY_GOOD_REGION_CONFLICT = 'GOOD_REGION_CONFLICT';
    public const QUALITY_CONFIRMED_MANUALLY = 'CONFIRMED_MANUALLY';

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

    public function getQualityCode(): string
    {
        return $this->get('quality-code');
    }

    public function isUseful(): bool
    {
        return
            $this->getQualityCode() === self::QUALITY_CONFIRMED_MANUALLY
            ||
            \strpos($this->getQualityCode(), self::QUALITY_GOOD) === 0;
    }
}
