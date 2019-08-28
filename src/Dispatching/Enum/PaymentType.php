<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Enum;

final class PaymentType
{
    /**
     * Способы оплаты.
     *
     * @see https://otpravka.pochta.ru/specification#/enums-payment-methods
     */
    public const STAMP               = 'STAMP';
    public const CASHLESS            = 'CASHLESS';
    public const FRANKING            = 'FRANKING';
    public const TO_FRANKING         = 'TO_FRANKING';
    public const ONLINE_PAYMENT_MARK = 'ONLINE_PAYMENT_MARK';
}
