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
 * Тип конверта.
 *
 * @see https://otpravka.pochta.ru/specification#/enums-base-envelope-type
 *
 * @method static EnvelopeType C4() 229 × 324 мм
 * @method static EnvelopeType C5() 162 × 229 мм
 * @method static EnvelopeType DL() 110 × 220 мм
 * @method static EnvelopeType A6() 105 × 148 мм
 * @method static EnvelopeType A7() 74 × 105 мм
 */
final class EnvelopeType extends Enum
{
    /** 229 × 324 мм */
    private const C4 = 'C4';
    /** 162 × 229 мм */
    private const C5 = 'C5';
    /** 110 × 220 мм */
    private const DL = 'DL';
    /** 105 × 148 мм */
    private const A6 = 'A6';
    /** 74 × 105 мм */
    private const A7 = 'A7';
}
