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
 * Типоразмер РПО.
 *
 * @see https://otpravka.pochta.ru/specification#/enums-dimension-type
 *
 * @method static DimensionType S() до 260 × 170 × 80 мм
 * @method static DimensionType M() до 300 × 200 × 150 мм
 * @method static DimensionType L() до 400 × 270 × 180 мм
 * @method static DimensionType XL() до 530 × 260 × 220 мм
 * @method static DimensionType OVERSIZED() Негабарит — сумма сторон не более 1400 мм, сторона не более 600 мм
 */
final class DimensionType extends Enum
{
    /** до 260 × 170 × 80 мм */
    private const S = 'S';
    /** до 300 × 200 × 150 мм */
    private const M = 'M';
    /** до 400 × 270 × 180 мм */
    private const L = 'L';
    /** до 530 × 260 × 220 мм */
    private const XL = 'XL';
    /** Негабарит — сумма сторон не более 1400 мм, сторона не более 600 мм */
    private const OVERSIZED = 'OVERSIZED';
}
