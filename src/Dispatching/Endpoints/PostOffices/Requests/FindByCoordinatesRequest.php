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

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\PostOffices\Requests;

use Appwilio\RussianPostSDK\Dispatching\Contracts\Arrayable;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\PostOffices\Responses\Coordinates;

final class FindByCoordinatesRequest implements Arrayable
{
    public const ALL               = 'ALL';
    public const ROUND_THE_CLOCK   = 'ROUND_THE_CLOCK';
    public const WORK_ON_WEEKENDS  = 'WORK_ON_WEEKENDS';
    public const CURRENTLY_WORKING = 'CURRENTLY_WORKING';

    private const AVAILABLE_FILTERS = [
        self::ROUND_THE_CLOCK,
        self::WORK_ON_WEEKENDS,
        self::CURRENTLY_WORKING,
    ];

    /** @var array */
    private $data;

    public static function fromCoordinates(Coordinates $coordinates)
    {
        return new self($coordinates, null, null);
    }

    public static function fromYandexData(string $yandexAddress, string $yandexGeo)
    {
        return new self(null, $yandexAddress, $yandexGeo);
    }

    public function __construct(...$args)
    {
        [$coordinates, $yAddress, $yGeo] = $args;

        if ($coordinates instanceof Coordinates && \count($args) === 1) {
            $this->data = $coordinates->toArray();
        } else if ($coordinates === null && \is_string($yAddress) && \is_string($yGeo)) {
            $this->data = [
                'geo-object'     => $yGeo,
                'yandex-address' => $yAddress,
            ];
        } else {
            throw new \InvalidArgumentException(
                'Используйте для создания запроса методы "fromCoordinates" или "fromYandexData".'
            );
        }

        $this->data['filter'] = self::ALL;
    }

    public function filterByWorkingTime(string $value)
    {
        if (\in_array($value, self::AVAILABLE_FILTERS)) {
            $this->data['filter'] = self::ALL;

            return $this;
        }

        throw new \InvalidArgumentException();
    }

    public function filterByType(bool $value = true)
    {
        $this->data['filter-by-office-type'] = $value;

        return $this;
    }

    public function onDateTime(\DateTimeInterface $dateTime)
    {
        $this->data['current-date-time'] = $dateTime->format('Y-m-dTH:m:s');

        return $this;
    }

    public function radius(int $radius)
    {
        $this->data['radius'] = $radius;

        return $this;
    }

    public function hidePrivate(bool $hidePrivate = true)
    {
        $this->data['hide-private'] = $hidePrivate;

        return $this;
    }

    public function take(int $value = 3)
    {
        $this->data['top'] = $value;

        return $this;
    }

    public function toArray(): array
    {
        return $this->data;
    }
}
