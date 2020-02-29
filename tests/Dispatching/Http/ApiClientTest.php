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

namespace Appwilio\RussianPostSDK\Tests\Dispatching\Http;

use Psr\Log\NullLogger;
use GuzzleHttp\Client as HttpClient;
use PHPUnit\Framework\MockObject\MockObject;
use Appwilio\RussianPostSDK\Tests\TestCase;
use Appwilio\RussianPostSDK\Dispatching\Http\ApiClient;
use Appwilio\RussianPostSDK\Dispatching\Http\Authentication;

class ApiClientTest extends TestCase
{
    public function test_client_is_instantiable(): void
    {
        $this->assertInstanceOf(
            ApiClient::class,
            new ApiClient(new Authentication('foo', 'bar', '123'), $this->createHttpClient(), new NullLogger())
        );
    }

    /**
     * @return HttpClient|MockObject
     */
    private function createHttpClient()
    {
        $httpClient = $this->getMockBuilder(HttpClient::class)
            ->setMethods(['send'])
            ->getMock();

        $httpClient
            ->expects($this->any())
            ->method('send');

        return $httpClient;
    }
}
