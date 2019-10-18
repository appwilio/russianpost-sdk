<?php

/**
 * This file is part of RussianPost SDK package.
 *
 * © Appwilio (http://appwilio.com), greabock (https://github.com/greabock), JhaoDa (https://github.com/jhaoda)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Exceptions;

final class CalculationException extends \DomainException
{
    public const ZERO_TOTAL_RATE = 1;

    public static function becauseZeroTotalRate(): self
    {
        return new self('Почта России вернула нулевой расчёт стоимости доставки.', self::ZERO_TOTAL_RATE);
    }
}
