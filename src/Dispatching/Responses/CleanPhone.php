<?php
declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Responses;

use JMS\Serializer\Annotation AS JMS;

class CleanPhone
{

    /**
     * @JMS\Type("string")
     */
    public $id;

    /**
     * @JMS\Type("string")
     * @JMS\SerializedName("original-phone")
     */
    public $original_phone;

    /**
     * @JMS\Type("string")
     * @JMS\SerializedName("phone-city-code")
     */
    public $phone_city_code;

    /**
     * @JMS\Type("string")
     * @JMS\SerializedName("phone-country-code")
     */
    public $phone_country_code;

    /**
     * @JMS\Type("string")
     * @JMS\SerializedName("phone-extension")
     */
    public $phone_extension;

    /**
     * @JMS\Type("string")
     * @JMS\SerializedName("phone-number")
     */
    public $phone_number;

    /**
     * @JMS\Type("string")
     * @JMS\SerializedName("quality-code")
     */
    public $quality_code;

}
