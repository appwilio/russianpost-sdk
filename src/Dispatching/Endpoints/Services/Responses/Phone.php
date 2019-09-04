<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses;

use JMS\Serializer\Annotation AS JMS;

final class Phone
{
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

    /**
     * @JMS\Type("string")
     * @var string
     */
    private $id;

    /**
     * @JMS\SerializedName("phone-country-code")
     * @JMS\Type("string")
     * @var string
     */
    private $countryCode;

    /**
     * @JMS\SerializedName("phone-city-code")
     * @JMS\Type("string")
     * @var string
     */
    private $cityCode;

    /**
     * @JMS\SerializedName("phone-number")
     * @JMS\Type("string")
     * @var string
     */
    private $number;

    /**
     * @JMS\SerializedName("phone-extension")
     * @JMS\Type("string")
     * @var string
     */
    private $extension;

    /**
     * @JMS\SerializedName("original-phone")
     * @JMS\Type("string")
     * @var string
     */
    private $originalPhone;

    /**
     * @JMS\SerializedName("quality-code")
     * @JMS\Type("string")
     * @var string
     */
    private $qualityCode;

    public function getId(): string
    {
        return $this->id;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function getCityCode(): string
    {
        return $this->cityCode;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function getExtension(): string
    {
        return $this->extension;
    }

    public function getOriginalPhone(): string
    {
        return $this->originalPhone;
    }

    public function isUseful(): bool
    {
        return
            $this->qualityCode === self::QUALITY_CONFIRMED_MANUALLY
            ||
            \strpos($this->qualityCode, self::QUALITY_GOOD) === 0;
    }
}
