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
 * Код качества нормализации ФИО.
 *
 * @see https://otpravka.pochta.ru/specification#/enums-clean-fio-quality
 *
 * @method static FioQuality EDITED() Правильное значение
 * @method static FioQuality NOT_SURE() Сомнительное значение
 * @method static FioQuality CONFIRMED_MANUALLY() Подтверждено контролером
 */
final class FioQuality extends Enum
{
    /** Правильное значение */
    private const EDITED = 'EDITED';
    /** Сомнительное значение */
    private const NOT_SURE = 'NOT_SURE';
    /** Подтверждено контролером */
    private const CONFIRMED_MANUALLY = 'CONFIRMED_MANUALLY';
}
