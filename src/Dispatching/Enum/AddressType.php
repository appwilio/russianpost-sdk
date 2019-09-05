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
