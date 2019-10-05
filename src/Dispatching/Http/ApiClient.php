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

use GuzzleHttp\Psr7\Request;
use Psr\Log\LoggerInterface;
use Psr\Log\LoggerAwareTrait;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\UploadedFile;
use Psr\Log\LoggerAwareInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Appwilio\RussianPostSDK\Dispatching\Instantiator;
use Appwilio\RussianPostSDK\Dispatching\Contracts\Arrayable;
use Appwilio\RussianPostSDK\Dispatching\Exceptions\BadRequest;
use Appwilio\RussianPostSDK\Dispatching\Contracts\DispatchingException;
use function GuzzleHttp\Psr7\stream_for;
use function GuzzleHttp\Psr7\build_query;

final class ApiClient
{
    use LoggerAwareTrait;

    private const API_URL = 'https://otpravka-api.pochta.ru';

    /** @var Authentication */
    private $authentication;

    /** @var ClientInterface */
    private $httpClient;

    public function __construct(Authentication $authentication, ClientInterface $httpClient)
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
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    private function send(string $method, string $path, ?Arrayable $request = null, $responseType = null)
    {
        $method = \strtoupper($method);

        try {
            $response = $this->httpClient->send($this->buildHttpRequest($method, $path, $request));

            $contenType = $response->getHeaderLine('Content-Type');

            if (\preg_match('~^application/(pdf|zip)$~', $contenType, $matches)) {
                return $this->buildFile($response, $matches[1]);
            }

            if (\preg_match('~^application/json~', $contenType)) {
                $content = $this->getResponseContent($response);

                $this->logger->info("pochta.ru Dispatching response: {$response->getBody()->getContents()}.");

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
            throw $e;
        }
    }

    private function buildHttpRequest(string $method, string $path, ?Arrayable $payload): RequestInterface
    {
        $request = $this->authentication->authenticate(
            new Request($method, self::API_URL.$path, ['Accept' => 'application/json;charset=UTF-8'])
        );

        if ($payload === null) {
            return $request;
        }

        $data = \array_filter($payload->toArray());

        if ($method === 'GET') {
            $query = guzzle_build_query($data);

            return guzzle_modify_request($request, \compact('query'));
        }

        $body = guzzle_json_encode($data);

        $this->logger->info('pochta.ru Dispatching request: '.self::API_URL.$path, [$body]);

        return $request
            ->withHeader('Content-Type', 'application/json;charset=UTF-8')
            ->withBody(stream_for(\json_encode($data)));
    }

    private function buildFile(ResponseInterface $response, string $type): UploadedFile
    {
        \preg_match('~=(.+)$~', $response->getHeaderLine('Content-Disposition'), $matches);

        $this->logger->info("pochta.ru Dispatching response: file {$matches[1]}.{$type} ({$response->getBody()->getSize()} butes).");

        return new UploadedFile(
            $response->getBody(),
            $response->getBody()->getSize(),
            \UPLOAD_ERR_OK,
            "{$matches[1]}.{$type}",
            $response->getHeaderLine('Content-Type')
        );
    }

    private function handleClientException(ClientException $exception): DispatchingException
    {
        if (\in_array($exception->getCode(), [401, 403])) {
            throw $this->handleAuthenticationException($exception);
        }

        $content = $this->getResponseContent($exception->getResponse());

        return new BadRequest(
            $content['message'] ?? $content['error'] ?? $content['desc'],
            (int) ($content['status'] ?? $content['code'] ?? $exception->getCode())
        );
    }

    private function handleAuthenticationException(ClientException $exception)
    {
        $content = $this->getResponseContent($exception->getResponse());

        return new BadRequest(
            $content['message'] ?? $content['desc'] ?? '',
            $content['code'] ? (int) $content['code'] : $exception->getCode()
        );
    }

    private function handleServerException(ServerException $e): DispatchingException
    {
        throw $e;
    }

    private function getResponseContent(ResponseInterface $response): array
    {
        return \json_decode((string) $response->getBody(), true);
    }
}
