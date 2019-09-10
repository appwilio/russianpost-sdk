<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Orders;

use Appwilio\RussianPostSDK\Dispatching\Http\ApiClient;
use Appwilio\RussianPostSDK\Dispatching\Contracts\Arrayable;
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

        return $response['errors'] ?? $response;
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

        return $response['result-ids'] ?? $response['errors'] ?? $response;
    }
}
