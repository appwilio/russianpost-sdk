<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Exceptions;

class PaymentMethodException extends \Exception
{
    public static function incorrectMethod(): self
    {
        return new self('Указан некорректный способ оплаты');
    }
}
