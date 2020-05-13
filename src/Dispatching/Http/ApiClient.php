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

namespace Appwilio\RussianPostSDK\Dispatching\Http;

use Psr\Log\LoggerInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerAwareInterface;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\UploadedFile;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Appwilio\RussianPostSDK\Core\Arrayable;
use Appwilio\RussianPostSDK\Dispatching\Instantiator;
use Appwilio\RussianPostSDK\Dispatching\Exceptions\BadRequest;
use Appwilio\RussianPostSDK\Dispatching\Exceptions\ServerFault;
use Appwilio\RussianPostSDK\Dispatching\Contracts\DispatchingException;
use function GuzzleHttp\json_encode as guzzle_json_encode;
use function GuzzleHttp\json_decode as guzzle_json_decode;
use function GuzzleHttp\Psr7\stream_for as guzzle_stream_for;
use function GuzzleHttp\Psr7\build_query as guzzle_build_query;
use function GuzzleHttp\Psr7\modify_request as guzzle_modify_request;

final class ApiClient implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    private const API_URL = 'https://otpravka-api.pochta.ru';

    /** @var Authentication */
    private $authentication;

    /** @var ClientInterface */
    private $httpClient;

    public function __construct(Authentication $authentication, ClientInterface $httpClient, LoggerInterface $logger)
    {
        $this->authentication = $authentication;
        $this->httpClient = $httpClient;
        $this->logger = $logger;
    }

    public function get(string $path, ?Arrayable $request = null, $type = null)
    {
        return $this->send('GET', ...\func_get_args());
    }

    public function post(string $path, Arrayable $request, $type = null)
    {
        return $this->send('POST', ...\func_get_args());
    }

    public function put(string $path, Arrayable $request, $type = null)
    {
        return $this->send('PUT', ...\func_get_args());
    }

    public function delete(string $path, Arrayable $request, $type = null)
    {
        return $this->send('DELETE', ...\func_get_args());
    }

    /**
     * Выполнение запроса.
     *
     * @param  string          $method
     * @param  string          $path
     * @param  Arrayable|null  $request
     * @param  mixed           $responseType
     *
     * @throws DispatchingException
     *
     * @return mixed
     */
    private function send(string $method, string $path, ?Arrayable $request = null, $responseType = null)
    {
        $method = \strtoupper($method);

        try {
            $response = $this->httpClient->send($this->buildHttpRequest($method, $path, $request));

            $contentType = $response->getHeaderLine('Content-Type');

            if (\preg_match('~^application/(pdf|zip)$~', $contentType, $matches)) {
                return $this->buildFile($response, $matches[1]);
            }

            if (\preg_match('~^application/json~', $contentType)) {
                $content = $this->getResponseContent($response);

                $this->logger->info("Dispatching response: status={$response->getStatusCode()}", $content);

                return $responseType === null
                    ? $content
                    : Instantiator::instantiate($responseType, $content);
            }

            throw new BadRequest();
        } catch (ClientException $e) {
            throw $this->handleClientException($e);
        } catch (ServerException $e) {
            throw $this->handleServerException($e);
        } catch (\Exception $e) {
            $this->logException($e->getCode(), $e->getMessage());

            throw $e;
        }
    }

    private function buildHttpRequest(string $method, string $path, ?Arrayable $payload): RequestInterface
    {
        $request = $this->authentication->authenticate(
            new Request($method, self::API_URL.$path, ['Accept' => 'application/json;charset=UTF-8'])
        );

        if ($payload === null) {
            $this->logger->info("Dispatching request: {$path}");

            return $request;
        }

        $data = $this->serializeRequestData(\array_filter($payload->toArray()));

        $this->logger->info("Dispatching request: {$path}", $data);

        if ($method === 'GET') {
            return guzzle_modify_request($request, ['query' => guzzle_build_query($data)]);
        }

        return $request
            ->withHeader('Content-Type', 'application/json;charset=UTF-8')
            ->withBody(guzzle_stream_for(guzzle_json_encode($data)));
    }

    private function serializeRequestData(array $data): array
    {
        return \array_map(function ($value) {
            if (\is_object($value) && $value instanceof \JsonSerializable) {
                return $value->jsonSerialize();
            }

            if (\is_array($value)) {
                return $this->serializeRequestData($value);
            }

            return $value;
        }, $data);
    }

    private function buildFile(ResponseInterface $response, string $type): UploadedFile
    {
        \preg_match('~=(.+)$~', $response->getHeaderLine('Content-Disposition'), $matches);

        $fileName = "{$matches[1]}.{$type}";
        $fileSize = $response->getBody()->getSize();

        $this->logger->info(\vsprintf('Dispatching response: status=%s, file=%s, size=%s bytes', [
            $response->getStatusCode(),
            $fileName,
            $fileSize,
        ]));

        return new UploadedFile(
            $response->getBody(), $fileSize, \UPLOAD_ERR_OK, $fileName, $response->getHeaderLine('Content-Type')
        );
    }

    private function handleClientException(ClientException $exception): BadRequest
    {
        if (\in_array($exception->getCode(), [401, 403])) {
            throw $this->handleAuthenticationException($exception);
        }

        $content = $this->getResponseContent($exception->getResponse());

        $this->logException($exception->getCode(), $exception->getMessage(), $content);

        return new BadRequest(
            $content['message'] ?? $content['error'] ?? $content['desc'],
            (int) ($content['status'] ?? $content['code'] ?? $exception->getCode())
        );
    }

    private function handleAuthenticationException(ClientException $exception): BadRequest
    {
        $content = $this->getResponseContent($exception->getResponse());

        $this->logException($exception->getCode(), $exception->getMessage(), $content);

        return new BadRequest(
            $content['message'] ?? $content['desc'] ?? '',
            isset($content['code']) ? (int) $content['code'] : $exception->getCode(),
            $exception
        );
    }

    private function handleServerException(ServerException $exception): ServerFault
    {
        return new ServerFault($exception->getMessage(), $exception->getCode(), $exception);
    }

    private function getResponseContent(ResponseInterface $response): array
    {
        return guzzle_json_decode((string) $response->getBody(), true);
    }

    private function logException(int $status, string $message, array $data = []): void
    {
        $this->logger->error("code={$status}, {$message}", $data);
    }
}
