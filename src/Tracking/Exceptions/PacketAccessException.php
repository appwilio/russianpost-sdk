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

class PacketAccessException extends \Exception
{
    public static function trackNumberLimitExceeded(): self
    {
        return new self('Максимально допустимое количество треков в одном запросе – 3 000.');
    }
}
