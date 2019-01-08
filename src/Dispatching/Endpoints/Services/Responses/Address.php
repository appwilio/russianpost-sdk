<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses;

use JMS\Serializer\Annotation AS JMS;

final class Address
{
    public const TYPE_PO_BOX = 'PO_BOX';
    public const TYPE_DEMAND = 'DEMAND';
    public const TYPE_DEFAULT = 'DEFAULT';

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

    public const VALIDATION_VALIDATED = 'VALIDATED';
    public const VALIDATION_OVERRIDDEN = 'OVERRIDDEN';
    public const VALIDATION_CONFIRMED_MANUALLY = 'CONFIRMED_MANUALLY';

    /**
     * @JMS\Type("string")
     */
    public $id;

    /**
     * @JMS\Type("string")
     */
    public $index;

    /**
     * @JMS\Type("string")
     */
    public $area;

    /**
     * @JMS\Type("string")
     */
    public $place;

    /**
     * @JMS\Type("string")
     */
    public $region;

    /**
     * @JMS\Type("string")
     */
    public $location;

    /**
     * @JMS\Type("string")
     */
    public $street;

    /**
     * @JMS\Type("string")
     */
    public $house;

    /**
     * @JMS\Type("string")
     */
    public $room;

    /**
     * @JMS\Type("string")
     */
    public $slash;

    /**
     * @JMS\Type("string")
     */
    public $building;

    /**
     * @JMS\Type("string")
     */
    public $corpus;

    /**
     * @JMS\Type("string")
     */
    public $letter;

    /**
     * @JMS\Type("string")
     * @JMS\SerializedName("num-address-type")
     */
    public $numAddressType;

    /**
     * @JMS\Type("string")
     * @JMS\SerializedName("original-address")
     */
    public $originalAddress;

    /**
     * @JMS\Type("string")
     * @JMS\SerializedName("address-type")
     *
     */
    public $addressType;

    /**
     * @JMS\Type("string")
     * @JMS\SerializedName("quality-code")
     */
    public $qualityCode;

    /**
     * @JMS\Type("string")
     * @JMS\SerializedName("validation-code")
     */
    public $validationCode;

    public function isUseful(): bool
    {
        $quality = \in_array($this->qualityCode, [
            self::QUALITY_GOOD, self::QUALITY_POSTAL_BOX, self::QUALITY_ON_DEMAND, self::QUALITY_UNDEF_05
        ]);

        $validity = \in_array($this->validationCode, [
            self::VALIDATION_VALIDATED, self::VALIDATION_OVERRIDDEN, self::VALIDATION_CONFIRMED_MANUALLY
        ]);

        return $quality && $validity;
    }
}
