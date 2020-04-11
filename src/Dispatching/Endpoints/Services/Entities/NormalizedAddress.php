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

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Entities;

use Appwilio\RussianPostSDK\Dispatching\Entities\AbstractAddress;

final class NormalizedAddress extends AbstractAddress
{
    /**
     * Коды качества нормализации адреса.
     *
     * @see https://otpravka.pochta.ru/specification#/enums-clean-address-quality
     */
    public const QUALITY_GOOD = 'GOOD';
    public const QUALITY_ON_DEMAND = 'ON_DEMAND';
    public const QUALITY_POSTAL_BOX = 'POSTAL_BOX';
    public const QUALITY_UNDEF_01 = 'UNDEF_01';
    public const QUALITY_UNDEF_02 = 'UNDEF_02';
    public const QUALITY_UNDEF_03 = 'UNDEF_03';
    public const QUALITY_UNDEF_04 = 'UNDEF_04';
    public const QUALITY_UNDEF_05 = 'UNDEF_05';
    public const QUALITY_UNDEF_06 = 'UNDEF_06';
    public const QUALITY_UNDEF_07 = 'UNDEF_07';

    /**
     * Коды проверки нормализации адреса.
     *
     * @https://otpravka.pochta.ru/specification#/enums-clean-address-validation
     */
    public const VALIDATION_VALIDATED = 'VALIDATED';
    public const VALIDATION_OVERRIDDEN = 'OVERRIDDEN';
    public const VALIDATION_CONFIRMED_MANUALLY = 'CONFIRMED_MANUALLY';

    public const ACCEPTABLE_QUALITY = [
        self::QUALITY_GOOD, self::QUALITY_POSTAL_BOX, self::QUALITY_ON_DEMAND, self::QUALITY_UNDEF_05,
    ];

    public const ACCEPTABLE_VALIDITY = [
        self::VALIDATION_VALIDATED, self::VALIDATION_OVERRIDDEN, self::VALIDATION_CONFIRMED_MANUALLY,
    ];

    public function getId(): string
    {
        return $this->get('id');
    }

    public function getOriginalAddress(): string
    {
        return $this->get('original-address');
    }

    public function getAddressType(): string
    {
        return $this->get('address-type');
    }

    public function getQualityCode(): string
    {
        return $this->get('quality-code');
    }

    public function getValidationCode(): string
    {
        return $this->get('validation-code');
    }

    public function isUseful(): bool
    {
        $quality = \in_array($this->getQualityCode(), self::ACCEPTABLE_QUALITY);
        $validity = \in_array($this->getValidationCode(), self::ACCEPTABLE_VALIDITY);

        return $quality && $validity;
    }

    public function isUnuseful(): bool
    {
        return ! $this->isUseful();
    }
}
