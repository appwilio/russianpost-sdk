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
 * Код качества нормализации телефона.
 *
 * @see https://otpravka.pochta.ru/specification#/enums-clean-fio-phone-quality
 *
 * @method static PhoneQuality UNDEF() Телефон не может быть распознан
 * @method static PhoneQuality EMPTY() Пустой телефонный номер
 * @method static PhoneQuality GARBAGE() Телефонный номер содержит некорректные символы
 * @method static PhoneQuality INCORRECT_DATA() Телефон не может быть распознан
 * @method static PhoneQuality FOREIGN() Иностранный телефонный номер
 * @method static PhoneQuality CODE_AMBI() Неоднозначный код телефонного номера
 * @method static PhoneQuality GOOD() Корректный телефонный номер
 * @method static PhoneQuality GOOD_CITY() Восстановлен город в телефонном номере
 * @method static PhoneQuality GOOD_EXTRA_PHONE() Запись содержит более одного телефона
 * @method static PhoneQuality GOOD_REPLACED_CODE() Изменен код телефонного номера
 * @method static PhoneQuality GOOD_REPLACED_NUMBER() Изменен номер телефона
 * @method static PhoneQuality GOOD_REPLACED_CODE_NUMBER() Изменен код и номер телефона
 * @method static PhoneQuality GOOD_CITY_CONFLICT() Конфликт по городу
 * @method static PhoneQuality GOOD_REGION_CONFLICT() Конфликт по региону
 * @method static PhoneQuality CONFIRMED_MANUALLY() Подтверждено контролером
 */
final class PhoneQuality extends Enum
{
    /** Телефон не может быть распознан */
    private const UNDEF = 'UNDEF';
    /** Пустой телефонный номер */
    private const EMPTY = 'EMPTY';
    /** Телефонный номер содержит некорректные символы */
    private const GARBAGE = 'GARBAGE';
    /** Телефон не может быть распознан */
    private const INCORRECT_DATA = 'INCORRECT_DATA';
    /** Иностранный телефонный номер */
    private const FOREIGN = 'FOREIGN';
    /** Неоднозначный код телефонного номера */
    private const CODE_AMBI = 'CODE_AMBI';
    /** Корректный телефонный номер */
    private const GOOD = 'GOOD';
    /** Восстановлен город в телефонном номере */
    private const GOOD_CITY = 'GOOD_CITY';
    /** Запись содержит более одного телефона */
    private const GOOD_EXTRA_PHONE = 'GOOD_EXTRA_PHONE';
    /** Изменен код телефонного номера */
    private const GOOD_REPLACED_CODE = 'GOOD_REPLACED_CODE';
    /** Изменен номер телефона */
    private const GOOD_REPLACED_NUMBER = 'GOOD_REPLACED_NUMBER';
    /** Изменен код и номер телефона */
    private const GOOD_REPLACED_CODE_NUMBER = 'GOOD_REPLACED_CODE_NUMBER';
    /** Конфликт по городу */
    private const GOOD_CITY_CONFLICT = 'GOOD_CITY_CONFLICT';
    /** Конфликт по региону */
    private const GOOD_REGION_CONFLICT = 'GOOD_REGION_CONFLICT';
    /** Подтверждено контролером */
    private const CONFIRMED_MANUALLY = 'CONFIRMED_MANUALLY';
}
