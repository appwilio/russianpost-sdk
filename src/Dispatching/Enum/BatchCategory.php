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
 * Категория партии.
 *
 * @see https://otpravka.pochta.ru/specification#/enums-base-batch-category
 *
 * @method static BatchCategory SIMPLE() Простое
 * @method static BatchCategory ORDERED() Заказное
 * @method static BatchCategory ORDINARY() Обыкновенное
 * @method static BatchCategory COMBINED() Комбинированное
 * @method static BatchCategory DECLARED_VALUE() С объявленной ценностью
 * @method static BatchCategory COMPULSORY_PAYMENT() С обязательным платежом
 * @method static BatchCategory DECLARED_VALUE_AND_CASH_ON_DELIVERY() С объявленной ценностью и наложенным платежом
 * @method static BatchCategory DECLARED_VALUE_AND_COMPULSORY_PAYMENT() С объявленной ценностью и обязательным платежом
 */
final class BatchCategory extends Enum
{
    /** Простое */
    private const SIMPLE = 'SIMPLE';
    /** Заказное */
    private const ORDERED = 'ORDERED';
    /** Обыкновенное */
    private const ORDINARY = 'ORDINARY';
    /** Комбинированное */
    private const COMBINED = 'COMBINED';
    /** С объявленной ценностью */
    private const DECLARED_VALUE = 'WITH_DECLARED_VALUE';
    /** С обязательным платежом */
    private const COMPULSORY_PAYMENT = 'WITH_COMPULSORY_PAYMENT';
    /** С объявленной ценностью и наложенным платежом */
    private const DECLARED_VALUE_AND_CASH_ON_DELIVERY = 'WITH_DECLARED_VALUE_AND_CASH_ON_DELIVERY';
    /** С объявленной ценностью и обязательным платежом */
    private const DECLARED_VALUE_AND_COMPULSORY_PAYMENT = 'WITH_DECLARED_VALUE_AND_COMPULSORY_PAYMENT';
}
