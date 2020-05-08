<?php

/**
 * This file is part of RussianPost SDK package.
 *
 * © Appwilio (http://appwilio.com), JhaoDa (https://github.com/jhaoda)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/** @noinspection PhpUnusedPrivateFieldInspection */

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Enum;

use Appwilio\RussianPostSDK\Core\Enum;

/**
 * Способ оплаты.
 *
 * @see https://otpravka.pochta.ru/specification#/enums-payment-methods
 *
 * @method static PaymentType STAMP() Оплата марками
 * @method static PaymentType CASHLESS() Безналичный расчет
 * @method static PaymentType FRANKING() Франкирование
 * @method static PaymentType TO_FRANKING() На франкировку
 * @method static PaymentType ONLINE_PAYMENT_MARK() Знак онлайн оплаты
 */
final class PaymentType extends Enum
{
    /** Оплата марками */
    private const STAMP = 'STAMP';
    /** Безналичный расчет */
    private const CASHLESS = 'CASHLESS';
    /** Франкирование */
    private const FRANKING = 'FRANKING';
    /** На франкировку */
    private const TO_FRANKING = 'TO_FRANKING';
    /** Знак онлайн оплаты */
    private const ONLINE_PAYMENT_MARK = 'ONLINE_PAYMENT_MARK';
}
