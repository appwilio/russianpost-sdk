<?php

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
