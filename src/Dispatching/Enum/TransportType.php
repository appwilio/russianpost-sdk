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
 * Вид транспортировки.
 *
 * @see https://otpravka.pochta.ru/specification#/enums-base-transport-type
 *
 * @method static TransportType AVIA() Авиа
 * @method static TransportType EXPRESS() Системой ускоренной почты
 * @method static TransportType SURFACE() Наземный
 * @method static TransportType STANDARD() Для отправлений «EMS Оптимальное»
 * @method static TransportType COMBINED() Комбинированный
 */
final class TransportType extends Enum
{
    /** Авиа */
    private const AVIA = 'AVIA';
    /** Системой ускоренной почты */
    private const EXPRESS = 'EXPRESS';
    /** Наземный */
    private const SURFACE = 'SURFACE';
    /** Для отправлений «EMS Оптимальное» */
    private const STANDARD = 'STANDARD';
    /** Комбинированный */
    private const COMBINED = 'COMBINED';
}
