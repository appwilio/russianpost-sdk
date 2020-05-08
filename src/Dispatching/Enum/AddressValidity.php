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
 * Код проверки нормализации адреса.
 *
 * @see https://otpravka.pochta.ru/specification#/enums-clean-address-validation
 *
 * @method static AddressValidity VALIDATED() Уверенное распознавание
 * @method static AddressValidity OVERRIDDEN() Распознан: адрес был перезаписан в справочнике
 * @method static AddressValidity CONFIRMED_MANUALLY() Подтверждено контролером
 * @method static AddressValidity NOT_VALIDATED_FOREIGN() Иностранный адрес
 * @method static AddressValidity NOT_VALIDATED_HAS_AMBI() На проверку, неоднозначность
 * @method static AddressValidity NOT_VALIDATED_DICTIONARY() На проверку, не по справочнику
 * @method static AddressValidity NOT_VALIDATED_HAS_ASSUMPTION() На проверку, предположение
 * @method static AddressValidity NOT_VALIDATED_INCORRECT_HOUSE() На проверку, некорректный дом
 * @method static AddressValidity NOT_VALIDATED_HAS_UNPARSED_PARTS() На проверку, неразобранные части
 * @method static AddressValidity NOT_VALIDATED_HAS_NO_MAIN_POINTS() На проверку, нет основных частей
 * @method static AddressValidity NOT_VALIDATED_HAS_NO_KLADR_RECORD() На проверку, нет в КЛАДР
 * @method static AddressValidity NOT_VALIDATED_EXCEDED_HOUSE_NUMBER() На проверку, большой номер дома
 * @method static AddressValidity NOT_VALIDATED_INCORRECT_HOUSE_EXTENSION() На проверку, некорректное расширение дома
 * @method static AddressValidity NOT_VALIDATED_HOUSE_WITHOUT_STREET_OR_NP() На проверку, нет улицы или населенного пункта
 * @method static AddressValidity NOT_VALIDATED_HAS_NUMBER_STREET_ASSUMPTION() На проверку, предположение по улице
 * @method static AddressValidity NOT_VALIDATED_HOUSE_EXTENSION_WITHOUT_HOUSE() На проверку, нет дома
 */
final class AddressValidity extends Enum
{
    /** Уверенное распознавание */
    private const VALIDATED = 'VALIDATED';
    /** Распознан: адрес был перезаписан в справочнике */
    private const OVERRIDDEN = 'OVERRIDDEN';
    /** Подтверждено контролером */
    private const CONFIRMED_MANUALLY = 'CONFIRMED_MANUALLY';
    /** Иностранный адрес */
    private const NOT_VALIDATED_FOREIGN = 'NOT_VALIDATED_FOREIGN';
    /** На проверку, неоднозначность */
    private const NOT_VALIDATED_HAS_AMBI = 'NOT_VALIDATED_HAS_AMBI';
    /** На проверку, не по справочнику */
    private const NOT_VALIDATED_DICTIONARY = 'NOT_VALIDATED_DICTIONARY';
    /** На проверку, предположение */
    private const NOT_VALIDATED_HAS_ASSUMPTION = 'NOT_VALIDATED_HAS_ASSUMPTION';
    /** На проверку, некорректный дом */
    private const NOT_VALIDATED_INCORRECT_HOUSE = 'NOT_VALIDATED_INCORRECT_HOUSE';
    /** На проверку, неразобранные части */
    private const NOT_VALIDATED_HAS_UNPARSED_PARTS = 'NOT_VALIDATED_HAS_UNPARSED_PARTS';
    /** На проверку, нет основных частей */
    private const NOT_VALIDATED_HAS_NO_MAIN_POINTS = 'NOT_VALIDATED_HAS_NO_MAIN_POINTS';
    /** На проверку, нет в КЛАДР */
    private const NOT_VALIDATED_HAS_NO_KLADR_RECORD = 'NOT_VALIDATED_HAS_NO_KLADR_RECORD';
    /** На проверку, большой номер дома */
    private const NOT_VALIDATED_EXCEDED_HOUSE_NUMBER = 'NOT_VALIDATED_EXCEDED_HOUSE_NUMBER';
    /** На проверку, некорректное расширение дома */
    private const NOT_VALIDATED_INCORRECT_HOUSE_EXTENSION = 'NOT_VALIDATED_INCORRECT_HOUSE_EXTENSION';
    /** На проверку, нет улицы или населенного пункта */
    private const NOT_VALIDATED_HOUSE_WITHOUT_STREET_OR_NP = 'NOT_VALIDATED_HOUSE_WITHOUT_STREET_OR_NP';
    /** На проверку, предположение по улице */
    private const NOT_VALIDATED_HAS_NUMBER_STREET_ASSUMPTION = 'NOT_VALIDATED_HAS_NUMBER_STREET_ASSUMPTION';
    /** На проверку, нет дома */
    private const NOT_VALIDATED_HOUSE_EXTENSION_WITHOUT_HOUSE = 'NOT_VALIDATED_HOUSE_EXTENSION_WITHOUT_HOUSE';

    /**
     * Коды проверки нормализации, при которых адрес считается приемлемым для доставки.
     *
     * @return array
     */
    public static function ACCEPTABLE_OPTIONS(): array
    {
        return [self::VALIDATED(), self::OVERRIDDEN(), self::CONFIRMED_MANUALLY()];
    }
}
