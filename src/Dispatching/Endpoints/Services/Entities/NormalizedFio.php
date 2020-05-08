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
use Appwilio\RussianPostSDK\Dispatching\Enum\FioQuality;

final class NormalizedFio
{
    use DataAware;

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

    public function getQualityCode(): FioQuality
    {
        return new FioQuality($this->get('quality-code'));
    }
}
