<?php

/**
 * This file is part of RussianPost SDK package.
 *
 * © Appwilio (http://appwilio.com), greabock (https://github.com/greabock), JhaoDa (https://github.com/jhaoda)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/** @noinspection PhpUnusedPrivateFieldInspection */

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Enum;

use Appwilio\RussianPostSDK\Core\Enum;

/**
 * Код качества нормализации адреса.
 *
 * @see https://otpravka.pochta.ru/specification#/enums-clean-address-quality
 *
 * @method static AddressQuality GOOD() Пригоден для почтовой рассылки
 * @method static AddressQuality ON_DEMAND() До востребования
 * @method static AddressQuality POSTAL_BOX() Абонентский ящик
 * @method static AddressQuality UNDEF_01() Не определен регион
 * @method static AddressQuality UNDEF_02() Не определен город или населенный пункт
 * @method static AddressQuality UNDEF_03() Не определена улица
 * @method static AddressQuality UNDEF_04() Не определен номер дома
 * @method static AddressQuality UNDEF_05() Не определена квартира/офис
 * @method static AddressQuality UNDEF_06() Не определен
 * @method static AddressQuality UNDEF_07() Иностранный адрес
 */
final class AddressQuality extends Enum
{
    /** Пригоден для почтовой рассылки */
    private const GOOD = 'GOOD';
    /** До востребования */
    private const ON_DEMAND = 'ON_DEMAND';
    /** Абонентский ящик */
    private const POSTAL_BOX = 'POSTAL_BOX';
    /** Не определен регион */
    private const UNDEF_01 = 'UNDEF_01';
    /** Не определен город или населенный пункт */
    private const UNDEF_02 = 'UNDEF_02';
    /** Не определена улица */
    private const UNDEF_03 = 'UNDEF_03';
    /** Не определен номер дома */
    private const UNDEF_04 = 'UNDEF_04';
    /** Не определена квартира/офис */
    private const UNDEF_05 = 'UNDEF_05';
    /** Не определен */
    private const UNDEF_06 = 'UNDEF_06';
    /** Иностранный адрес */
    private const UNDEF_07 = 'UNDEF_07';

    /**
     * Коды качества нормализации, при которых адрес считается приемлемым для доставки.
     *
     * @return array
     */
    public static function ACCEPTABLE_OPTIONS(): array
    {
        return [self::GOOD(), self::UNDEF_05(), self::ON_DEMAND(), self::POSTAL_BOX()];
    }
}
