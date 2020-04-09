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

use Appwilio\RussianPostSDK\Dispatching\DataAware;
use Appwilio\RussianPostSDK\Dispatching\Contracts\Arrayable;

final class NormalizedFio implements Arrayable
{
    use DataAware;

    /**
     * Коды качества нормализации ФИО.
     *
     * @see https://otpravka.pochta.ru/specification#/enums-clean-fio-quality
     */
    public const QUALITY_EDITED = 'EDITED';
    public const QUALITY_NOT_SURE = 'NOT_SURE';
    public const QUALITY_CONFIRMED_MANUALLY = 'CONFIRMED_MANUALLY';

    public function getId(): string
    {
        return $this->get('id');
    }

    public function getFirstName(): ?string
    {
        return $this->get('name');
    }

    public function getMiddleName(): ?string
    {
        return $this->get('middle-name');
    }

    public function getLastName(): ?string
    {
        return $this->get('surname');
    }

    public function getOriginalFio(): string
    {
        return $this->get('original-fio');
    }

    public function getQualityCode(): string
    {
        return $this->get('quality-code');
    }
}
