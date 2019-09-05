<?php

/**
 * This file is part of RussianPost SDK package.
 *
 * © Appwilio (http://appwilio.com), JhaoDa (https://github.com/jhaoda)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Enum;

final class MailEntryType
{
    /**
     * Категории вложения.
     *
     * @see https://otpravka.pochta.ru/specification#/enums-base-entries-type
     */
    public const GIFT              = 'GIFT';
    public const OTHER             = 'OTHER';
    public const DOCUMENT          = 'DOCUMENT';
    public const SALE_OF_GOODS     = 'SALE_OF_GOODS';
    public const COMMERCIAL_SAMPLE = 'COMMERCIAL_SAMPLE';
}
