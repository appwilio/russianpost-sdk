<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses;

use JMS\Serializer\Annotation AS JMS;

final class Phone
{
    /**
     * Коды качества нормализации телефона
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

    /**
     * @JMS\Type("string")
     */
    public $id;

    /**
     * @JMS\Type("string")
     * @JMS\SerializedName("phone-country-code")
     */
    public $countryCode;

    /**
     * @JMS\Type("string")
     * @JMS\SerializedName("phone-city-code")
     */
    public $cityCode;

    /**
     * @JMS\Type("string")
     * @JMS\SerializedName("phone-number")
     */
    public $number;

    /**
     * @JMS\Type("string")
     * @JMS\SerializedName("phone-extension")
     */
    public $extension;

    /**
     * @JMS\Type("string")
     * @JMS\SerializedName("original-phone")
     */
    public $originalPhone;

    /**
     * @JMS\Type("string")
     * @JMS\SerializedName("quality-code")
     */
    public $qualityCode;

    public function isUseful(): bool
    {
        return
            $this->qualityCode === self::QUALITY_CONFIRMED_MANUALLY
            ||
            strpos($this->qualityCode, self::QUALITY_GOOD) === 0;
    }
}
