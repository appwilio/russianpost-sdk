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
 * Категория уведомления о вручении РПО.
 *
 * @see https://otpravka.pochta.ru/specification#/enums-base-notify-category
 *
 * @method static NotifyCategory SIMPLE() Простое
 * @method static NotifyCategory ORDERED() Заказное
 * @method static NotifyCategory ELECTRONIC() Электронное
 */
final class NotifyCategory extends Enum
{
    /** Простое */
    private const SIMPLE  = 'SIMPLE';
    /** Заказное */
    private const ORDERED = 'ORDERED';
    /** Электронное */
    private const ELECTRONIC = 'ELECTRONIC';
}
