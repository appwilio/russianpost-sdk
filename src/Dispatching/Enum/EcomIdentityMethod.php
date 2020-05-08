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
 * Способ идентификации получателя для Ecom-отправлений.
 *
 * @see https://otpravka.pochta.ru/specification#/enums-identity-methods
 *
 * @method static EcomIdentityMethod PIN() Пин-код (для почтоматов и партнерских ПВЗ)
 * @method static EcomIdentityMethod IDENTITY_DOCUMENT() Удостоверяющий личность документ
 * @method static EcomIdentityMethod ORDER_NUM_AND_FIO() Номер заказа и ФИО (для отделений почтовой связи)
 * @method static EcomIdentityMethod WITHOUT_IDENTIFICATION() Без идентификации
 */
final class EcomIdentityMethod extends Enum
{
    /** Пин-код (для почтоматов и партнерских ПВЗ) */
    private const PIN = 'PIN';
    /** Удостоверяющий личность документ */
    private const IDENTITY_DOCUMENT = 'IDENTITY_DOCUMENT';
    /** Номер заказа и ФИО (для отделений почтовой связи) */
    private const ORDER_NUM_AND_FIO = 'ORDER_NUM_AND_FIO';
    /** Без идентификации */
    private const WITHOUT_IDENTIFICATION = 'WITHOUT_IDENTIFICATION';
}
