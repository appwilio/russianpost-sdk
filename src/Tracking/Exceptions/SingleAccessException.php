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

namespace Appwilio\RussianPostSDK\Tracking\Exceptions;

class SingleAccessException extends \Exception
{
    public const EMPTY_TRACKING_RESPONSE = 1;
    public const EMPTY_COD_RESPONSE      = 2;

    public static function becauseEmptyTrackingResponse(string $trackingNumber): self
    {
        return new self(
            "Почта России не смогла найти событий трекинга для РПО #{$trackingNumber}.",
            self::EMPTY_TRACKING_RESPONSE
        );
    }

    public static function becauseEmptyCODResponse(string $trackingNumber): self
    {
        return new self(
            "Почта России не смогла найти событий обработки наложенного платежа для РПО #{$trackingNumber}.",
            self::EMPTY_COD_RESPONSE
        );
    }
}
