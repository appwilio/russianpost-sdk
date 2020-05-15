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

namespace Appwilio\RussianPostSDK\Tests\Dispatching;

use Psr\Log\NullLogger;
use GuzzleHttp\Client as HttpClient;
use PHPUnit\Framework\MockObject\MockObject;
use Appwilio\RussianPostSDK\Tests\TestCase;
use Appwilio\RussianPostSDK\Dispatching\DispatchingClient;
use Appwilio\RussianPostSDK\Dispatching\Exceptions\UnknownEndpoint;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Orders\Orders;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Batches\Batches;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Settings\Settings;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Services;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Documents\Documents;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\PostOffices\PostOffices;

class DispatchingClientTest extends TestCase
{
    public function test_client_is_instantiable(): void
    {
        $this->assertInstanceOf(DispatchingClient::class, $this->createClient());

        /** @noinspection PhpVoidFunctionResultUsedInspection */
        $this->assertNull($this->createClient()->setLogger(new NullLogger()));
    }

    public function test_can_get_endpoint(): void
    {
        $client = $this->createClient();

        $this->assertInstanceOf(Orders::class, $client->orders);
        $this->assertInstanceOf(Batches::class, $client->batches);
        $this->assertInstanceOf(Settings::class, $client->settings);
        $this->assertInstanceOf(Services::class, $client->services);
        $this->assertInstanceOf(Documents::class, $client->documents);
        $this->assertInstanceOf(PostOffices::class, $client->postoffices);
    }

    public function test_exception_thrown_on_unknown_endpoint(): void
    {
        $this->expectException(UnknownEndpoint::class);

        $this->createClient()->{'foobar'};
    }

    private function createClient(): DispatchingClient
    {
        /** @var HttpClient|MockObject $httpClient */
        $httpClient = $this->createMock(HttpClient::class);

        return new DispatchingClient('foo', 'bar', '123', $httpClient);
    }
}
