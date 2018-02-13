<?php
declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Responses;

use JMS\Serializer\Annotation AS JMS;

class CleanAddress
{

    /**
     * @JMS\Type("string")
     * @JMS\SerializedName("address-type")
     *
     */
    public $address_type;

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
     * @JMS\SerializedName("original-address")
     */
    public $original_address;

    /**
     * @JMS\Type("string")
     */
    public $place;

    /**
     * @JMS\Type("string")
     * @JMS\SerializedName("quality-code")
     */
    public $quality_code;

    /**
     * @JMS\Type("string")
     */
    public $region;

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
     * @JMS\SerializedName("validation-code")
     */
    public $validation_code;

}
