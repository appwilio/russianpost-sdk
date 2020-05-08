<?php

/**
 * This file is part of RussianPost SDK package.
 *
 * © Appwilio (http://appwilio.com), greabock (https://github.com/greabock), JhaoDa (https://github.com/jhaoda)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/** @noinspection PhpUnusedPrivateFieldInspection */

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Enum;

use Appwilio\RussianPostSDK\Core\Enum;

/**
 * Способ расчета.
 *
 * @see https://otpravka.pochta.ru/specification#/enums-payattr
 *
 * @method static PaymentMode54FZ FULL_PREPAYMENT() Полная предварительная оплата до момента передачи предмета расчёта
 * @method static PaymentMode54FZ PARTIAL_PREPAYMENT() Частичная предварительная оплата до момента передачи предмета расчёта
 * @method static PaymentMode54FZ ADVANCE() Аванс
 * @method static PaymentMode54FZ FULL_PAYMENT() Полная оплата, в том числе с учётом аванса (предварительной оплаты) в момент передачи предмета расчёта
 * @method static PaymentMode54FZ PARTIAL_PAYMENT() Частичная оплата предмета расчёта в момент его передачи с последующей оплатой в кредит
 * @method static PaymentMode54FZ CREDIT() Передача предмета расчёта без его оплаты в момент его передачи с последующей оплатой в кредит
 * @method static PaymentMode54FZ CREDIT_PAYMENT() Оплата предмета расчёта после его передачи с оплатой в кредит (оплата кредита)
 */
final class PaymentMode54FZ extends Enum
{
    /** Полная предварительная оплата до момента передачи предмета расчёта */
    private const FULL_PREPAYMENT = 1;
    /** Частичная предварительная оплата до момента передачи предмета расчёта*/
    private const PARTIAL_PREPAYMENT = 2;
    /** Аванс */
    private const ADVANCE = 3;
    /** Полная оплата, в том числе с учётом аванса (предварительной оплаты) в момент передачи предмета расчёта */
    private const FULL_PAYMENT = 4;
    /** Частичная оплата предмета расчёта в момент его передачи с последующей оплатой в кредит */
    private const PARTIAL_PAYMENT = 5;
    /** Передача предмета расчёта без его оплаты в момент его передачи с последующей оплатой в кредит */
    private const CREDIT = 6;
    /** Оплата предмета расчёта после его передачи с оплатой в кредит (оплата кредита) */
    private const CREDIT_PAYMENT = 7;
}
