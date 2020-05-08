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
 * Тип печати (формат адресного ярлыка).
 *
 * @see https://otpravka.pochta.ru/specification#/enums-base-print-type
 *
 * @method static PrintType PAPER() А5, 14,8 × 21 см, лазерная и струйная печать
 * @method static PrintType THERMO() А6, 10 × 15 см, термопечать
 */
final class PrintType extends Enum
{
    /** А5, 14,8 × 21 см, лазерная и струйная печать */
    private const PAPER  = 'PAPER';
    /** А6, 10 × 15 см, термопечать */
    private const THERMO = 'THERMO';
}
