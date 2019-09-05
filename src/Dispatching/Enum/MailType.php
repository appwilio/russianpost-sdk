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

final class MailType
{
    /**
     * Типы РПО.
     *
     * @see https://otpravka.pochta.ru/specification#/enums-base-mail-type
     */
    public const EMS         = 'EMS';
    public const EMS_RT      = 'EMS_RT';
    public const EMS_OPTIMAL = 'EMS_OPTIMAL';

    public const BANDEROL             = 'BANDEROL';
    public const BANDEROL_FIRST_CLASS = 'BANDEROL_CLASS_1';

    public const LETTER             = 'LETTER';
    public const LETTER_FIRST_CLASS = 'LETTER_CLASS_1';

    public const PARCEL_POSTAL      = 'POSTAL_PARCEL';
    public const PARCEL_ONLINE      = 'ONLINE_PARCEL';
    public const PARCEL_FIRST_CLASS = 'PARCEL_CLASS_1';

    public const BUSINESS_COURIER    = 'BUSINESS_COURIER';
    public const BUSINESS_COURIER_ES = 'BUSINESS_COURIER_ES';

    public const COMBINED       = 'COMBINED';
    public const VGPO_CLASS_1   = 'VGPO_CLASS_1';
    public const SMALL_PACKET   = 'SMALL_PACKET';
    public const ONLINE_COURIER = 'ONLINE_COURIER';
}
