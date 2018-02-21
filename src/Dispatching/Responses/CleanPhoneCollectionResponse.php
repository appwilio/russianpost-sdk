<?php
declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Responses;

use JMS\Serializer\Annotation AS JMS;

class CleanPhoneCollectionResponse
{

    /**
     * @JMS\Type("array<Appwilio\RussianPostSDK\Dispatching\Responses\CleanPhone>")
     * @JMS\SerializedName("body")
     */
    public $phones = [];

}
