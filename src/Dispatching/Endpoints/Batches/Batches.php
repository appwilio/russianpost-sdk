<?php

/**
 * This file is part of RussianPost SDK package.
 *
 * © Appwilio (http://appwilio.com), greabock (https://github.com/greabock), JhaoDa (https://github.com/jhaoda)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Batches;

use Appwilio\RussianPostSDK\Core\ArrayOf;
use Appwilio\RussianPostSDK\Core\GenericRequest;
use Appwilio\RussianPostSDK\Dispatching\Http\ApiClient;
use Appwilio\RussianPostSDK\Dispatching\Exceptions\BadRequest;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Orders\Entites\Order;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Batches\Entites\Batch;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Orders\Exceptions\OrderNotFound;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Batches\Exceptions\BatchNotFound;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Batches\Requests\FindBatchRequest;

final class Batches
{
    /** @var ApiClient */
    private $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    /**
     * Получение партии по имени (идентификатору).
     *
     * @see https://otpravka.pochta.ru/specification#/batches-find_batch
     *
     * @param  string  $name  имя (идентификатор) партии
     *
     * @throws OrderNotFound
     *
     * @return Batch
     */
    public function getByName(string $name): Batch
    {
        try {
            return $this->client->get("/1.0/batch/{$name}", null, Batch::class);
        } catch (BadRequest $e) {
            throw new BatchNotFound($name, $e);
        }
    }

    /**
     * Поиск партий.
     *
     * @see https://otpravka.pochta.ru/specification#/batches-search_all_batches
     *
     * @param  FindBatchRequest  $request
     *
     * @return iterable|Batch[]|null
     */
    public function find(FindBatchRequest $request): ?iterable
    {
        $response = $this->client->get('/1.0/batch', $request, new ArrayOf(Batch::class));

        return empty($response) ? null : $response;
    }

    /**
     * Запрос данных о заказах в партии.
     *
     * @see https://otpravka.pochta.ru/specification#/batches-get_info_about_orders_in_batch
     *
     * @param  string    $name
     * @param  int|null  $page
     * @param  int|null  $perPage
     * @param  string    $sortBy
     *
     * @return Order[]
     */
    public function getOrdersInBatch(string $name, ?int $page = null, ?int $perPage = null, string $sortBy = 'asc')
    {
        $query = GenericRequest::create([
            'page' => $page,
            'size' => $perPage,
            'sort' => $sortBy,
        ]);

        return $this->client->get("/1.0/batch/{$name}/shipment", $query, new ArrayOf(Order::class));
    }

    public function getOrderById(string $id): Order
    {
        try {
            return $this->client->get("/1.0/shipment/{$id}", null, Order::class);
        } catch (BadRequest $e) {
            throw new OrderNotFound($id, $e);
        }
    }

    /**
     * Поиск заказов по ШПИ или внутреннему номеру во всех партиях.
     *
     * @param  string  $query  ШПИ или внутренний номер заказа
     *
     * @see https://otpravka.pochta.ru/specification#/batches-find_orders_with_barcode
     *
     * @return Order[]|null
     */
    public function findOrdersInAllBatches(string $query): ?iterable
    {
        return $this->client->get(
            '/1.0/shipment/search',
            GenericRequest::create(['query' => $query]),
            new ArrayOf(Order::class)
        );
    }
}
