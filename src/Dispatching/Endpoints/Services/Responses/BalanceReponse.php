<?php

declare(strict_types = 1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses;

use JMS\Serializer\Annotation AS JMS;

final class BalanceReponse
{
    private $balance;

    public function getBalance()
    {
        return $this->balance;
    }
}
