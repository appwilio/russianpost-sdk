<?php

declare(strict_types = 1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses;

use JMS\Serializer\Annotation AS JMS;

final class Fio
{
    public const QUALITY_EDITED = 'EDITED';
    public const QUALITY_NOT_SURE = 'NOT_SURE';
    public const QUALITY_CONFIRMED_MANUALLY = 'CONFIRMED_MANUALLY';

    /**
     * @JMS\Type("string")
     */
    public $id;

    /**
     * @JMS\Type("string")
     * @JMS\SerializedName("name")
     */
    public $firstName;

    /**
     * @JMS\Type("string")
     * @JMS\SerializedName("middle-name")
     */
    public $middleName;

    /**
     * @JMS\Type("string")
     * @JMS\SerializedName("surname")
     */
    public $lastName;

    /**
     * @JMS\Type("string")
     * @JMS\SerializedName("original-fio")
     */
    public $originalFio;

    /**
     * @JMS\Type("string")
     * @JMS\SerializedName("quality-code")
     */
    public $qualityCode;

    /**
     * @JMS\Type("bool")
     */
    public $valid;

    public function isUseful(): bool
    {
        return $this->valid;
    }
}
