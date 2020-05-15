<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Orders;

use Appwilio\RussianPostSDK\Core\Arrayable;
use Appwilio\RussianPostSDK\Core\ArrayOf;
use Appwilio\RussianPostSDK\Dispatching\Http\ApiClient;
use Appwilio\RussianPostSDK\Dispatching\Exceptions\BadRequest;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Orders\Entites\Order;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Orders\Requests\OrderRequest;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Orders\Exceptions\OrderNotFound;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Orders\Exceptions\OrderException;

final class Orders
{
    /** @var ApiClient */
    private $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    /**
     * Создание заказа.
     *
     * @see https://otpravka.pochta.ru/specification#/orders-creating_order
     *
     * @param  OrderRequest  $request
     *
     * @throws OrderException
     *
     * @return string номер созданного заказа
     */
    public function create(OrderRequest $request): string
    {
        $response = $this->client->put('/1.0/user/backlog', $request);

        if (isset($response['result-ids'])) {
            return (string) $response['result-ids'][0];
        }

        if (isset($response['errors'])) {
            throw new OrderException($response['errors'][0]['error-codes']);
        }

        return $response;
    }

    /**
     * Получение заказа по внутрипочтовому идентификатору.
     *
     * @see https://otpravka.pochta.ru/specification#/orders-search_order_byid
     *
     * @param  string  $id  внутрипочтовый идентификатор
     *
     * @throws OrderNotFound
     *
     * @return Order
     */
    public function getById(string $id)
    {
        try {
            return $this->client->get("/1.0/backlog/{$id}", null, Order::class);
        } catch (BadRequest $e) {
            throw new OrderNotFound($id, $e);
        }
    }

    /**
     * Поиск заказов по идентификатору в системе отправителя.
     *
     * @see https://otpravka.pochta.ru/specification#/orders-search_order
     *
     * @param  string  $number  идентификатор в системе отправителя
     *
     * @return iterable|Order[]|null
     */
    public function findByShopNumber(string $number): ?iterable
    {
        $response = $this->client->get(
            '/1.0/backlog/search?'.\http_build_query(['query' => $number]), null, new ArrayOf(Order::class)
        );

        return empty($response) ? null : $response;
    }

    /**
     * Редактирование заказа.
     *
     * @see https://otpravka.pochta.ru/specification#/orders-editing_order
     *
     * @param  string        $id       внутрипочтовый идентификатор
     * @param  OrderRequest  $request
     *
     * @throws OrderNotFound
     *
     * @return Order
     */
    public function update(string $id, OrderRequest $request)
    {
        try {
            return $this->client->put("/1.0/backlog/{$id}", $request);
        } catch (BadRequest $e) {
            throw new OrderNotFound($id, $e);
        }
    }

    public function delete(array $ids)
    {
        $response = $this->client->delete('/1.0/user/backlog', new class($ids) implements Arrayable {
            private $ids;

            public function __construct(array $ids)
            {
                $this->ids = $ids;
            }

            public function toArray(): array
            {
                return $this->ids;
            }
        });

        if (isset($response['errors'])) {
            throw new OrderException($response['errors'][0]);
        }
    }

    public function renew(array $ids)
    {
        return $this->client->post('/1.0/user/backlog', new class($ids) implements Arrayable {
            private $ids;

            public function __construct(array $ids)
            {
                $this->ids = $ids;
            }

            public function toArray(): array
            {
                return $this->ids;
            }
        });
    }
}
