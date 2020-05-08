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
 * Категория РПО.
 *
 * @see https://otpravka.pochta.ru/specification#/enums-base-mail-category
 *
 * @method static MailCategory SIMPLE() Простое
 * @method static MailCategory ORDERED() Заказное
 * @method static MailCategory ORDINARY() Обыкновенное
 * @method static MailCategory COMPULSORY() С обязательным платежом
 * @method static MailCategory DECLARED() С объявленной ценностью
 * @method static MailCategory DECLARED_CASH() С объявленной ценностью и наложенным платежом
 * @method static MailCategory DECLARED_COMPULSORY() С объявленной ценностью и обязательным платежом
 */
final class MailCategory extends Enum
{
    /** Простое */
    private const SIMPLE = 'SIMPLE';
    /** Заказное */
    private const ORDERED = 'ORDERED';
    /** Обыкновенное */
    private const ORDINARY = 'ORDINARY';
    /** С обязательным платежом */
    private const COMPULSORY = 'WITH_COMPULSORY_PAYMENT';
    /** С объявленной ценностью */
    private const DECLARED = 'WITH_DECLARED_VALUE';
    /** С объявленной ценностью и наложенным платежом */
    private const DECLARED_CASH = 'WITH_DECLARED_VALUE_AND_CASH_ON_DELIVERY';
    /** С объявленной ценностью и обязательным платежом */
    private const DECLARED_COMPULSORY = 'WITH_DECLARED_VALUE_AND_COMPULSORY_PAYMENT';
}
