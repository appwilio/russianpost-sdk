<?php

declare(strict_types = 1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses;

final class BalanceReponse
{
    private $balance;

    public function getBalance()
    {
        return $this->balance;
    }
}
