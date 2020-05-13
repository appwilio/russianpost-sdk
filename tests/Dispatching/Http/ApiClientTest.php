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
use GuzzleHttp\Psr7\Stream;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\UploadedFile;
use GuzzleHttp\Client as HttpClient;
use Psr\Http\Message\RequestInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use PHPUnit\Framework\MockObject\MockObject;
use Appwilio\RussianPostSDK\Tests\TestCase;
use Appwilio\RussianPostSDK\Core\GenericRequest;
use Appwilio\RussianPostSDK\Dispatching\Http\ApiClient;
use Appwilio\RussianPostSDK\Dispatching\Http\Authentication;
use Appwilio\RussianPostSDK\Dispatching\Exceptions\BadRequest;
use Appwilio\RussianPostSDK\Dispatching\Exceptions\ServerFault;
use function GuzzleHttp\json_encode as guzzle_json_encode;
use function GuzzleHttp\Psr7\stream_for as guzzle_stream_for;

class ApiClientTest extends TestCase
{
    public function test_client_can_get(): void
    {
        $response = $this->createClient()->get('foo');
        $this->assertIsArray($response);
        $this->assertEmpty($response);

        $response = $this->createClient()->get('foo', GenericRequest::create(['foo' => 'bar']));
        $this->assertIsArray($response);
        $this->assertEmpty($response);
    }

    public function test_client_can_post(): void
    {
        $response = $this->createClient()->post('foo', GenericRequest::create(['foo' => 'bar']));
        $this->assertIsArray($response);
        $this->assertEmpty($response);
    }

    public function test_client_can_put(): void
    {
        $response = $this->createClient()->put('foo', GenericRequest::create(['foo' => 'bar']));
        $this->assertIsArray($response);
        $this->assertEmpty($response);
    }

    public function test_client_can_delete(): void
    {
        $response = $this->createClient()->delete('foo', GenericRequest::create(['foo' => 'bar']));
        $this->assertIsArray($response);
        $this->assertEmpty($response);
    }

    public function test_file(): void
    {
        $tmp = \tmpfile();
        \fwrite($tmp, \str_repeat('1', 1024));

        $file = new Stream($tmp);

        /** @var UploadedFile $response */
        $response = $this->createClient(
            $contentType = 'application/pdf',
            guzzle_stream_for($tmp),
            ['Content-Disposition' => 'attachment; filename=foo']
        )->get('foo');

        $this->assertInstanceOf(UploadedFile::class, $response);
        $this->assertEquals($file->getSize(), $response->getSize());
        $this->assertEquals($contentType, $response->getClientMediaType());
        $this->assertEquals('foo.pdf', $response->getClientFilename());
    }

    public function test_exception_thrown_on_invalid_content_type(): void
    {
        $this->expectException(BadRequest::class);

        $this->createClient('application/foobar')->get('foo');
    }

    /**
     * @param int $code
     * @param array $data
     * @dataProvider error4xxProvider
     */
    public function test_exception_thrown_on_4xx(int $code, array $data): void
    {
        $this->expectExceptionCode($code);
        $this->expectException(BadRequest::class);

        $client = new ApiClient(
            new Authentication('foo', 'bar', 'baz'),
            $http = $this->createHttpClient(null),
            new NullLogger()
        );

        $http->method('send')->willReturnCallback(function () use ($code, $data) {
            $response = new Response($code, [], guzzle_json_encode($data));

            throw new ClientException('', $this->createMock(RequestInterface::class), $response);
        });

        $client->get('foo');
    }

    public function test_exception_thrown_on_5xx(): void
    {
        $this->expectExceptionCode(500);
        $this->expectException(ServerFault::class);

        $client = new ApiClient(
            new Authentication('foo', 'bar', 'baz'),
            $http = $this->createHttpClient(null),
            new NullLogger()
        );

        $http->method('send')->willReturnCallback(function () {
            throw new ServerException('', $this->createMock(RequestInterface::class), new Response(500));
        });

        $client->get('foo');
    }

    public function error4xxProvider(): \Generator
    {
        foreach ([401, 403, 422] as $code) {
            yield [$code, ['desc' => 'foo', 'code' => $code]];
            yield [$code, ['error' => 'foo', 'code' => $code]];
            yield [$code, ['message' => 'foo', 'code' => $code]];

            yield [$code, ['desc' => 'foo', 'status' => $code]];
            yield [$code, ['error' => 'foo', 'status' => $code]];
            yield [$code, ['message' => 'foo', 'status' => $code]];
        }
    }

    private function createClient($contentType = 'application/json', $body = null, array $headers = []): ApiClient
    {
        return new ApiClient(
            new Authentication('foo', 'bar', 'baz'),
            $this->createHttpClient($body ?: '{}', $headers + ['Content-Type' => $contentType]),
            new NullLogger()
        );
    }

    /**
     * @param  mixed  $body
     * @param  array  $headers
     *
     * @return HttpClient|MockObject
     */
    private function createHttpClient($body, array $headers = [])
    {
        $httpClient = $this->createMock(HttpClient::class);

        $httpClient->method('send')->willReturnCallback(static function () use ($headers, $body) {
            return new Response(200, $headers, $body);
        });

        return $httpClient;
    }
}
