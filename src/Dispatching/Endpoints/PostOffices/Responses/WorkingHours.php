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

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\PostOffices\Responses;

use Appwilio\RussianPostSDK\Dispatching\DataAware;
use Appwilio\RussianPostSDK\Dispatching\Instantiator;
use Appwilio\RussianPostSDK\Dispatching\Http\ArrayOf;
use Appwilio\RussianPostSDK\Dispatching\Contracts\Arrayable;

final class WorkingHours implements Arrayable
{
    use DataAware;
    use TimeIntervalAware;

    public function getDayNumber(): ?int
    {
        return $this->get('weekday-id', 'int');
    }

    public function getDayName(?string $locale = null): ?string
    {
        if (null === $this->getDayNumber()) {
            return null;
        }

        if ($this->get('weekday-name')) {
            return $this->get('weekday-name');
        }

        return (new \IntlDateFormatter(
            $locale ?? 'ru_RU', \IntlDateFormatter::NONE, \IntlDateFormatter::NONE, null, null, 'EEEE'
        ))->format(\strtotime("next Sunday + {$this->getDayNumber()} days"));
    }

    /**
     * @return Lunch[]|null
     */
    public function getLunches()
    {
        return Instantiator::instantiate(new ArrayOf(Lunch::class), $this->get('lunches'));
    }

    protected function getBeginValue()
    {
        return $this->get('begin-worktime');
    }

    protected function getEndValue()
    {
        return $this->get('end-worktime');
    }
}
