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
 * Предмета расчета.
 *
 * @see https://otpravka.pochta.ru/specification#/enums-lineattr
 *
 * @method static PaymentSubject54FZ COMMODITY() Товар, за исключением подакцизного
 * @method static PaymentSubject54FZ EXCISE() Подакцизный товар
 * @method static PaymentSubject54FZ JOB() Работа
 * @method static PaymentSubject54FZ SERVICE() Услуга
 * @method static PaymentSubject54FZ GAMBLING_BET() Ставка в азартной игре
 * @method static PaymentSubject54FZ GAMBLING_PRIZE() Выигрыш в азартной игре
 * @method static PaymentSubject54FZ LOTTERY() Лотерейный билет
 * @method static PaymentSubject54FZ LOTTERY_PRIZE() Выигрыш в лотерею
 * @method static PaymentSubject54FZ INTELLECTUAL_ACTIVITY() Результаты интеллектуальной деятельности
 * @method static PaymentSubject54FZ PAYMENT() Платеж — аванс, задаток, предоплата, кредит, взнос в счет оплаты, пени, штраф, вознаграждении, бонус
 * @method static PaymentSubject54FZ AGENT_COMMISSION() Агентское вознаграждение платёжному агенту, комиссионеру, поверенному или иному агенту
 * @method static PaymentSubject54FZ COMPOSITE() Несколько вариантов
 * @method static PaymentSubject54FZ ANOTHER() Другое
 * @method static PaymentSubject54FZ PROPERTY_RIGHT() Имущественные права
 * @method static PaymentSubject54FZ NON_OPERATING_GAIN() Внереализационный доход
 * @method static PaymentSubject54FZ INSURANCE_PREMIUM() Страховой сбор
 * @method static PaymentSubject54FZ SALES_TAX() Торговый сбор
 * @method static PaymentSubject54FZ RESORT_FEE() Курортный сбор
 * @method static PaymentSubject54FZ LIEN() Залог
 */
final class PaymentSubject54FZ extends Enum
{
    /** Товар, за исключением подакцизного */
    private const COMMODITY = 1;
    /** Подакцизный товар */
    private const EXCISE = 2;
    /** Работа */
    private const JOB = 3;
    /** Услуга */
    private const SERVICE = 4;
    /** Ставка в азартной игре */
    private const GAMBLING_BET = 5;
    /** Выигрыш в азартной игре */
    private const GAMBLING_PRIZE = 6;
    /** Лотерейный билет */
    private const LOTTERY = 7;
    /** Выигрыш в лотерею */
    private const LOTTERY_PRIZE = 8;
    /** Результаты интеллектуальной деятельности */
    private const INTELLECTUAL_ACTIVITY = 9;
    /** Платеж — аванс, задаток, предоплата, кредит, взнос в счет оплаты, пени, штраф, вознаграждении, бонус */
    private const PAYMENT = 10;
    /** Агентское вознаграждение платёжному агенту, комиссионеру, поверенному или иному агенту */
    private const AGENT_COMMISSION = 11;
    /** Несколько вариантов */
    private const COMPOSITE = 12;
    /** Другое */
    private const ANOTHER = 13;
    /** Имущественные права */
    private const PROPERTY_RIGHT = 14;
    /** Внереализационный доход */
    private const NON_OPERATING_GAIN = 15;
    /** Страховой сбор */
    private const INSURANCE_PREMIUM = 16;
    /** Торговый сбор */
    private const SALES_TAX = 17;
    /** Курортный сбор */
    private const RESORT_FEE = 18;
    /** Залог */
    private const LIEN = 19;
}
