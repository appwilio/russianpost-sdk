<?php

/**
 * This file is part of RussianPost SDK package.
 *
 * © Appwilio (http://appwilio.com), JhaoDa (https://github.com/jhaoda)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
