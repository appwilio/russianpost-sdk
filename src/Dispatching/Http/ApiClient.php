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

use Appwilio\RussianPostSDK\Dispatching\Instantiator;
use Appwilio\RussianPostSDK\Dispatching\Contracts\Arrayable;
use Appwilio\RussianPostSDK\Dispatching\Exceptions\BadRequest;
use Appwilio\RussianPostSDK\Dispatching\Contracts\DispatchingException;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\UploadedFile;
use Psr\Http\Message\ResponseInterface;

final class ApiClient
{
    private const API_URL = 'https://otpravka-api.pochta.ru';

    private const COMMON_HEADERS = [
        'Accept' => 'application/json;charset=UTF-8',
    ];

    private const FILE_SIGNATURES = [
        'zip' => 'PK',
        'pdf' => '%PDF-',
    ];

    /** @var Authorization */
    private $auth;

    /** @var HttpClient */
    private $httpClient;

    /** @var array */
    private $httpOptions;

    public function __construct(Authorization $authorization, array $httpOptions)
    {
        $this->auth = $authorization;
        $this->httpOptions = $httpOptions;
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
     * @param  null            $type
     *
     * @throws DispatchingException
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    private function send(string $method, string $path, ?Arrayable $request = null, $type = null)
    {
        $response = null;

        try {
            $response = $this->getHttpClient()->request(
                $method, $path, $request ? $this->buildRequestOptions($method, $request) : []
            );
        } catch (ClientException $e) {
            if ($e->getCode() === 401) {
                throw $this->handleAuthenticationException($e);
            }

            throw $this->handleClientException($e);
        } catch (ServerException $e) {
            throw $this->handleServerException($e);
        } catch (\Exception $e) {
            throw $e;
        }

        if (null === $response) {
            return null;
        }

        $fileType = $this->guessFileType($response);

        if ($fileType) {
            return $this->buildFile($response, $fileType);
        }

        $content = $this->getResponseContent($response);

        if (null === $type) {
            return $content;
        }

        return Instantiator::instantiate($type, $content);
    }

    private function buildRequestOptions(string $method, Arrayable $request): array
    {
        $data = \array_filter($request->toArray());

        if ($method === 'GET') {
            return [
                'query' => $data,
            ];
        }

        return [
            'body'    => \json_encode($data),
            'headers' => [
                'Content-Type' => 'application/json;charset=UTF-8',
            ],
        ];
    }

    private function getHttpClient(): HttpClient
    {
        if ($this->httpClient === null) {
            $this->httpClient = new HttpClient(\array_merge(
                $this->httpOptions,
                [
                    'base_uri' => self::API_URL,
                    'headers'  => \array_merge(self::COMMON_HEADERS, $this->auth->toArray()),
                ]
            ));
        }

        return $this->httpClient;
    }

    private function guessFileType(Response $response): ?string
    {
        $chunk = $response->getBody()->read(10);

        foreach (self::FILE_SIGNATURES as $type => $signature) {
            if (0 === \stripos($chunk, $signature)) {
                $response->getBody()->rewind();

                return $type;
            }
        }

        return null;
    }

    private function buildFile(Response $response, string $type): UploadedFile
    {
        $name = \explode('=', $response->getHeaderLine('Content-Disposition') ?? '')[1] ?? '';

        return new UploadedFile(
            $response->getBody(),
            $response->getBody()->getSize(),
            \UPLOAD_ERR_OK,
            "{$name}.{$type}",
            $response->getHeaderLine('Content-Type')
        );
    }

    private function handleClientException(ClientException $exception): DispatchingException
    {
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
