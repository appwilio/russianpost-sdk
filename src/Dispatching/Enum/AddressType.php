<?php

/**
 * This file is part of RussianPost SDK package.
 *
 * © Appwilio (http://appwilio.com), JhaoDa (https://github.com/jhaoda)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/** @noinspection PhpUnusedPrivateFieldInspection */

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Enum;

use Appwilio\RussianPostSDK\Core\Enum;

/**
 * Тип адреса.
 *
 * @see https://otpravka.pochta.ru/specification#/enums-base-address-type
 *
 * @method static AddressType UNIT() Военная часть
 * @method static AddressType PO_BOX() Абонентский ящик
 * @method static AddressType DEMAND() До востребования
 * @method static AddressType DEFAULT() Стандартный — улица, дом, квартира
 */
final class AddressType extends Enum
{
    /** Военная часть */
    private const UNIT = 'UNIT';
    /** Абонентский ящик */
    private const PO_BOX = 'PO_BOX';
    /** До востребования */
    private const DEMAND = 'DEMAND';
    /** Стандартный — улица, дом, квартира */
    private const DEFAULT = 'DEFAULT';
}
