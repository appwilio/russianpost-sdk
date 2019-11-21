<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Orders;

use Appwilio\RussianPostSDK\Dispatching\Http\ApiClient;
use Appwilio\RussianPostSDK\Dispatching\Contracts\Arrayable;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Orders\Entites\Order;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Orders\Requests\OrderRequest;
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
     * @link https://otpravka.pochta.ru/specification#/orders-creating_order
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

    public function getByPostalId(string $id): Order
    {
        return $this->client->get("/1.0/backlog/{$id}", null, Order::class);
    }

    public function findByShopId(string $id)
    {
        return $this->client->get('backlog/search', new class($id) implements Arrayable {
            private $query;

            public function __construct(string $query)
            {
                $this->query = $query;
            }

            public function toArray(): array
            {
                return ['query' => $this->query];
            }
        }, Order::class);
    }

    public function findByTrackingNumber(string $number)
    {
        return $this->client->get('/1.0/shipment/search', new class($number) implements Arrayable {
            private $query;

            public function __construct(string $query)
            {
                $this->query = $query;
            }

            public function toArray(): array
            {
                return ['query' => $this->query];
            }
        }, Order::class);
    }

    public function read(string $id)
    {
        return $this->client->get("/1.0/user/backlog/{$id}");
    }

    public function update(string $id, OrderRequest $request)
    {
        return $this->client->put("/1.0/user/backlog/{$id}", $request);
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
