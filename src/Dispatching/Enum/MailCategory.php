<?php

declare(strict_types = 1);

namespace Appwilio\RussianPostSDK\Dispatching\Enum;

final class MailCategory
{
    /**
     * Категории РПО
     *
     * @see https://otpravka.pochta.ru/specification#/enums-base-mail-category
     */
    public const SIMPLE = 'SIMPLE';
    public const ORDERED = 'ORDERED';
    public const ORDINARY = 'ORDINARY';
    public const COMBINED = 'COMBINED';
    public const DECLARED = 'WITH_DECLARED_VALUE';
    public const DECLARED_CASH = 'WITH_DECLARED_VALUE_AND_CASH_ON_DELIVERY';
}