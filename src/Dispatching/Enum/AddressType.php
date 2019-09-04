<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Enum;

final class AddressType
{
    /**
     * Типы адресов.
     *
     * @see https://otpravka.pochta.ru/specification#/enums-base-address-type
     */
    public const UNIT    = 'UNIT';
    public const PO_BOX  = 'PO_BOX';
    public const DEMAND  = 'DEMAND';
    public const DEFAULT = 'DEFAULT';
}
