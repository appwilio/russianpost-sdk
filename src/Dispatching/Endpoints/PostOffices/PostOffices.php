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

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\PostOffices;

use Appwilio\RussianPostSDK\Dispatching\Http\ArrayOf;
use Appwilio\RussianPostSDK\Dispatching\Http\ApiClient;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\PostOffices\Responses\Service;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\PostOffices\Responses\PostOffice;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\PostOffices\Responses\Coordinates;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\PostOffices\Requests\FindByAddressRequest;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\PostOffices\Requests\FindByCoordinatesRequest;

final class PostOffices
{
    /** @var ApiClient */
    private $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    /**
     * Получение информации о почтовом отделении по индексу.
     *
     * https://otpravka.pochta.ru/specification#/services-postoffice
     *
     * Упомянутые в документации `current-date-time`, `filter-by-office-type` и `ufps-postal-code` ни на что не влияют.
     *
     * @param  string            $postalCode   индекс ОПС
     * @param  Coordinates|null  $coordinates  для расчёта дистанции до ОПС (в км)
     *
     * @return PostOffice
     */
    public function get(string $postalCode, ?Coordinates $coordinates = null): PostOffice
    {
        $query = null;

        if ($coordinates) {
            $query = \http_build_query($coordinates->toArray());
        }

        return $this->client->get("/postoffice/1.0/{$postalCode}".($query ? "?{$query}" : null), null, PostOffice::class);
    }

    /**
     * Поиск почтовых отделений по координатам.
     *
     * https://otpravka.pochta.ru/specification#/services-postoffice-nearby
     *
     * @param  FindByCoordinatesRequest  $request
     *
     * @return iterable|PostOffice[]
     */
    public function findByCoordinates(FindByCoordinatesRequest $request): iterable
    {
        return $this->client->get('/postoffice/1.0/nearby', $request, new ArrayOf(PostOffice::class));
    }

    /**
     * Поиск индексов обслуживающих ОПС по адресу.
     *
     * https://otpravka.pochta.ru/specification#/services-postoffice-by-address
     *
     * @param  FindByAddressRequest  $request
     *
     * @return iterable|string[]
     */
    public function findPostalCodesByAddress(FindByAddressRequest $request): iterable
    {
        return $this->client->get('/postoffice/1.0/by-address', $request);
    }

    /**
     * Поиск индексов ОПС в населённом пункте.
     *
     * https://otpravka.pochta.ru/specification#/services-postoffice-settlement.offices.codes
     *
     * @param  string       $settlement
     * @param  string|null  $region
     * @param  string|null  $district
     *
     * @return iterable|string[]
     */
    public function findPostalCodesForSettlement(string $settlement, ?string $region = null, ?string $district = null): iterable
    {
        $query = \http_build_query(\compact('settlement', 'region', 'district'));

        return $this->client->get("/postoffice/1.0/settlement.offices.codes?{$query}");
    }

    /**
     * Получение почтовых сервисов ОПС c опциональной фильтрацией по группе сервисов.
     *
     * https://otpravka.pochta.ru/specification#/services-postoffice-service
     * https://otpravka.pochta.ru/specification#/services-postoffice-service-group
     *
     * @param  string    $postalCode
     * @param  int|null  $group
     *
     * @return iterable|Service[]
     */
    public function getServices(string $postalCode, ?int $group = null): iterable
    {
        $path = "/postoffice/1.0/{$postalCode}/services".($group ? "/{$group}" : null);

        return $this->client->get($path, null, new ArrayOf(Service::class));
    }
}
