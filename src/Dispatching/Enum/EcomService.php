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
 * Вид сервиса, используемого для Ecom-отправлений.
 *
 * @see https://otpravka.pochta.ru/specification#/enums-ecom-services
 *
 * @method static EcomService WITH_FITTING() С примеркой
 * @method static EcomService WITHOUT_SERVICE() Без сервиса
 * @method static EcomService WITHOUT_OPENING() Без вскрытия
 * @method static EcomService COURIER_DELIVERY() Доставка курьером
 * @method static EcomService CONTENTS_CHECKING() С проверкой вложения
 * @method static EcomService PARTIAL_REDEMPTION() С частичным выкупом
 * @method static EcomService FUNCTIONALITY_CHECKING() С проверкой работоспособности
 */
final class EcomService extends Enum
{
    /** С примеркой */
    private const WITH_FITTING = 'WITH_FITTING';
    /** Без сервиса */
    private const WITHOUT_SERVICE = 'WITHOUT_SERVICE';
    /** Без вскрытия */
    private const WITHOUT_OPENING = 'WITHOUT_OPENING';
    /** Доставка курьером */
    private const COURIER_DELIVERY = 'COURIER_DELIVERY';
    /** С проверкой вложения */
    private const CONTENTS_CHECKING = 'CONTENTS_CHECKING';
    /** С частичным выкупом */
    private const PARTIAL_REDEMPTION = 'PARTIAL_REDEMPTION';
    /** С проверкой работоспособности */
    private const FUNCTIONALITY_CHECKING = 'FUNCTIONALITY_CHECKING';
}
