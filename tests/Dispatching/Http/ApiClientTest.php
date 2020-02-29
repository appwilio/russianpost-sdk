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
use GuzzleHttp\Psr7\UploadedFile;
use GuzzleHttp\Client as HttpClient;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ResponseInterface;
use PHPUnit\Framework\MockObject\MockObject;
use Appwilio\RussianPostSDK\Tests\TestCase;
use Appwilio\RussianPostSDK\Dispatching\Http\ApiClient;
use Appwilio\RussianPostSDK\Dispatching\Http\Authentication;
use Appwilio\RussianPostSDK\Dispatching\Contracts\Arrayable;
use Appwilio\RussianPostSDK\Dispatching\Exceptions\BadRequest;
use function GuzzleHttp\Psr7\stream_for as guzzle_stream_for;

class ApiClientTest extends TestCase
{
    public function test_client_can_get(): void
    {
        $response = $this->buildClient()->get('foo');
        $this->assertIsArray($response);
        $this->assertEmpty($response);
    }

    public function test_client_can_post(): void
    {
        $response = $this->buildClient()->post('foo', new FooRequest());
        $this->assertIsArray($response);
        $this->assertEmpty($response);
    }

    public function test_client_can_put(): void
    {
        $response = $this->buildClient()->put('foo', new FooRequest());
        $this->assertIsArray($response);
        $this->assertEmpty($response);
    }

    public function test_client_can_delete(): void
    {
        $response = $this->buildClient()->delete('foo', new FooRequest());
        $this->assertIsArray($response);
        $this->assertEmpty($response);
    }

    public function test_file(): void
    {
        $tmp = \tmpfile();
        \fwrite($tmp, \str_repeat('1', 1024));

        $file = new Stream($tmp);

        /** @var UploadedFile $response */
        $response = $this->buildClient(
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

        $this->buildClient('baz/bar')->get('foo');
    }

    private function buildClient($contentType = 'application/json', $body = null, array $headers = []): ApiClient
    {
        return new ApiClient(
            new Authentication('foo', 'bar', 'baz'),
            $this->createHttpClient($body ?: '{}', $headers + ['Content-Type' => $contentType]),
            new NullLogger()
        );
    }

    /**
     * @param mixed $body
     * @param array $headers
     * @return HttpClient|MockObject
     */
    private function createHttpClient($body, array $headers = [])
    {
        $response = $this->createMock(ResponseInterface::class);

        $response->method('getHeaderLine')->willReturnCallback(
            static function ($name) use ($headers) {
                return $headers[$name];
            }
        );

        $stream = $this->createMock(StreamInterface::class);
        $stream->method('__toString')->willReturn($body);
        $stream->method('getSize')->willReturnCallback(
            static function () use ($body) {
            if ($body instanceof StreamInterface) {
                return $body->getSize();
            }

            return \strlen($body);
        });
        $response->method('getBody')->willReturn($stream);

        $httpClient = $this->createMock(HttpClient::class);

        $httpClient->method('send')->willReturnCallback(
            static function () use ($response) {
                return $response;
            }
        );

        return $httpClient;
    }
}

class FooRequest implements Arrayable
{
    public function toArray(): array
    {
        return [
            'foo' => 'bar',
        ];
    }
}
