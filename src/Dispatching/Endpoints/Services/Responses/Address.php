<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses;

use JMS\Serializer\Annotation AS JMS;

final class Address
{
    /**
     * Коды качества нормализации адреса.
     *
     * @see https://otpravka.pochta.ru/specification#/enums-clean-address-quality
     */
    public const QUALITY_GOOD = 'GOOD';
    public const QUALITY_ON_DEMAND = 'ON_DEMAND';
    public const QUALITY_POSTAL_BOX = 'POSTAL_BOX';
    public const QUALITY_UNDEF_01 = 'UNDEF_01';
    public const QUALITY_UNDEF_02 = 'UNDEF_02';
    public const QUALITY_UNDEF_03 = 'UNDEF_03';
    public const QUALITY_UNDEF_04 = 'UNDEF_04';
    public const QUALITY_UNDEF_05 = 'UNDEF_05';
    public const QUALITY_UNDEF_06 = 'UNDEF_06';
    public const QUALITY_UNDEF_07 = 'UNDEF_07';

    /**
     * Коды проверки нормализации адреса.
     *
     * @https://otpravka.pochta.ru/specification#/enums-clean-address-validation
     */
    public const VALIDATION_VALIDATED = 'VALIDATED';
    public const VALIDATION_OVERRIDDEN = 'OVERRIDDEN';
    public const VALIDATION_CONFIRMED_MANUALLY = 'CONFIRMED_MANUALLY';

    /**
     * @JMS\Type("string")
     * @var string
     */
    private $id;

    /**
     * @JMS\Type("string")
     * @var string|null
     */
    private $index;

    /**
     * @JMS\Type("string")
     * @var string|null
     */
    private $area;

    /**
     * @JMS\Type("string")
     * @var string|null
     */
    private $place;

    /**
     * @JMS\Type("string")
     * @var string|null
     */
    private $region;

    /**
     * @JMS\Type("string")
     * @var string|null
     */
    private $location;

    /**
     * @JMS\Type("string")
     * @var string|null
     */
    private $street;

    /**
     * @JMS\Type("string")
     * @var string|null
     */
    private $house;

    /**
     * @JMS\Type("string")
     * @var string|null
     */
    private $room;

    /**
     * @JMS\Type("string")
     * @var string|null
     */
    private $slash;

    /**
     * @JMS\Type("string")
     * @var string|null
     */
    private $building;

    /**
     * @JMS\Type("string")
     * @var string|null
     */
    private $corpus;

    /**
     * @JMS\Type("string")
     * @var string|null
     */
    private $letter;

    /**
     * @JMS\Type("string")
     * @var string|null
     */
    protected $hotel;

    /**
     * @JMS\SerializedName("num-address-type")
     * @JMS\Type("string")
     * @var string|null
     */
    private $numAddressType;

    /**
     * @JMS\SerializedName("original-address")
     * @JMS\Type("string")
     * @var string
     */
    private $originalAddress;

    /**
     * @JMS\SerializedName("address-type")
     * @JMS\Type("string")
     * @var string
     *
     */
    private $addressType;

    /**
     * @JMS\SerializedName("quality-code")
     * @JMS\Type("string")
     * @var string
     */
    private $qualityCode;

    /**
     * @JMS\SerializedName("validation-code")
     * @JMS\Type("string")
     * @var string
     */
    private $validationCode;

    public function isUseful(): bool
    {
        $quality = \in_array($this->qualityCode, [
            self::QUALITY_GOOD, self::QUALITY_POSTAL_BOX, self::QUALITY_ON_DEMAND, self::QUALITY_UNDEF_05,
        ]);

        $validity = \in_array($this->validationCode, [
            self::VALIDATION_VALIDATED, self::VALIDATION_OVERRIDDEN, self::VALIDATION_CONFIRMED_MANUALLY,
        ]);

        return $quality && $validity;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getIndex(): ?string
    {
        return $this->index;
    }

    public function getArea(): ?string
    {
        return $this->area;
    }

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function getHouse(): ?string
    {
        return $this->house;
    }

    public function getRoom(): ?string
    {
        return $this->room;
    }

    public function getSlash(): ?string
    {
        return $this->slash;
    }

    public function getBuilding(): ?string
    {
        return $this->building;
    }

    public function getCorpus(): ?string
    {
        return $this->corpus;
    }

    public function getLetter(): ?string
    {
        return $this->letter;
    }

    public function getHotel(): ?string
    {
        return $this->hotel;
    }

    public function getNumAddressType(): ?string
    {
        return $this->numAddressType;
    }

    public function getOriginalAddress(): string
    {
        return $this->originalAddress;
    }

    public function getAddressType(): string
    {
        return $this->addressType;
    }

    public function getQualityCode(): string
    {
        return $this->qualityCode;
    }

    public function getValidationCode(): string
    {
        return $this->validationCode;
    }
}
