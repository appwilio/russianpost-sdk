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
 * Тип РПО.
 *
 * @see https://otpravka.pochta.ru/specification#/enums-base-mail-type
 *
 * @method static MailType EMS() Отправление EMS
 * @method static MailType EMS_RT() EMS РТ
 * @method static MailType EMS_TENDER() EMS тендер
 * @method static MailType EMS_OPTIMAL() EMS оптимальное
 * @method static MailType BANDEROL() Бандероль
 * @method static MailType BANDEROL_FIRST_CLASS() Бандероль 1-го класса
 * @method static MailType LETTER() Письмо
 * @method static MailType LETTER_FIRST_CLASS() Письмо 1-го класса
 * @method static MailType PARCEL_POSTAL() Посылка «нестандартная»
 * @method static MailType PARCEL_ONLINE() Посылка «онлайн»
 * @method static MailType PARCEL_FIRST_CLASS() Посылка 1-го класса
 * @method static MailType ONLINE_COURIER() Курьер «онлайн»
 * @method static MailType BUSINESS_COURIER() Бизнес курьер
 * @method static MailType BUSINESS_COURIER_ES() Бизнес курьер экпресс
 * @method static MailType VSD() Отправление ВСД (возврат сопроводительных документов)
 * @method static MailType ECOM() ЕКОМ
 * @method static MailType COMBINED() Комбинированное
 * @method static MailType EASY_RETURN() Легкий возврат
 * @method static MailType SMALL_PACKET() Мелкий пакет
 * @method static MailType VGPO_FIRST_CLASS() ВГПО 1-го класса (внутригородское почтовое отправление)
 * @method static MailType UNDEFINED() Не определено
 */
final class MailType extends Enum
{
    /** Отправление EMS */
    private const EMS         = 'EMS';
    /** EMS РТ */
    private const EMS_RT      = 'EMS_RT';
    /** EMS тендер */
    private const EMS_TENDER  = 'EMS_TENDER';
    /** EMS оптимальное */
    private const EMS_OPTIMAL = 'EMS_OPTIMAL';

    /** Бандероль */
    private const BANDEROL             = 'BANDEROL';
    /** Бандероль 1-го класса */
    private const BANDEROL_FIRST_CLASS = 'BANDEROL_CLASS_1';

    /** Письмо */
    private const LETTER             = 'LETTER';
    /** Письмо 1-го класса */
    private const LETTER_FIRST_CLASS = 'LETTER_CLASS_1';

    /** Посылка «нестандартная» */
    private const PARCEL_POSTAL      = 'POSTAL_PARCEL';
    /** Посылка «онлайн» */
    private const PARCEL_ONLINE      = 'ONLINE_PARCEL';
    /** Посылка 1-го класса */
    private const PARCEL_FIRST_CLASS = 'PARCEL_CLASS_1';

    /** Курьер «онлайн» */
    private const ONLINE_COURIER      = 'ONLINE_COURIER';
    /** Бизнес курьер */
    private const BUSINESS_COURIER    = 'BUSINESS_COURIER';
    /** Бизнес курьер экпресс */
    private const BUSINESS_COURIER_ES = 'BUSINESS_COURIER_ES';

    /** Отправление ВСД (возврат сопроводительных документов) */
    private const VSD              = 'VSD';
    /** ЕКОМ */
    private const ECOM             = 'ECOM';
    /** Комбинированное */
    private const COMBINED         = 'COMBINED';
    /** Легкий возврат */
    private const EASY_RETURN      = 'EASY_RETURN';
    /** Мелкий пакет */
    private const SMALL_PACKET     = 'SMALL_PACKET';
    /** ВГПО 1-го класса (внутригородское почтовое отправление) */
    private const VGPO_FIRST_CLASS = 'VGPO_CLASS_1';

    /** Не определено */
    public const UNDEFINED = 'UNDEFINED';
}
