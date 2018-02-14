<?php
declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Responses;

use JMS\Serializer\Annotation AS JMS;

class CleanAddressCollectionResponse
{

    /**
     * @JMS\Type("array<Appwilio\RussianPostSDK\Dispatching\Responses\CleanAddress>")
     * @JMS\SerializedName("body")
     */
    public $addresses = [];

}
