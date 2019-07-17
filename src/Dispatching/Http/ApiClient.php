<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Http;

use Appwilio\RussianPostSDK\Dispatching\Contracts\Arrayable;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\UploadedFile;
use JMS\Serializer\Handler\HandlerRegistryInterface;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;

final class ApiClient
{
    private const API_URL = 'https://otpravka-api.pochta.ru';

    private const COMMON_HEADERS = [
        'Accept' => 'application/json;charset=UTF-8'
    ];

    private const FILE_SIGNATURES = [
        'zip' => 'PK',
        'pdf' => '%PDF-',
    ];

    /** @var Authorization */
    private $auth;

    /** @var HttpClient */
    private $httpClient;

    /** @var Serializer */
    private $serializer;

    /** @var array */
    private $httpOptions;

    /** @var array */
    private $customDeserializators = [];

    public function __construct(Authorization $authorization, array $httpOptions)
    {
        $this->auth = $authorization;
        $this->httpOptions = $httpOptions;
    }

    public function get(string $path, ?Arrayable $request = null, ?string $class = null)
    {
        return $this->send('GET', ...\func_get_args());
    }

    public function post(string $path, Arrayable $request, ?string $class = null)
    {
        return $this->send('POST', ...\func_get_args());
    }

    public function put(string $path, Arrayable $request, ?string $class = null)
    {
        return $this->send('PUT', ...\func_get_args());
    }

    public function delete(string $path, Arrayable $request, ?string $class = null)
    {
        return $this->send('DELETE', ...\func_get_args());
    }

    public function addCustomDeserializator(string $type, string $class): void
    {
        $this->customDeserializators[$type] = $class;
    }

    private function createDesrializer(): Serializer
    {
        if (null === $this->serializer) {
            $this->serializer = SerializerBuilder::create()
                ->configureHandlers(function (HandlerRegistryInterface $registry) {
                    foreach ($this->customDeserializators as $class => $handler) {
                        $registry->registerHandler('deserialization', $class, 'json', new $handler);
                    }
                })
                ->build();
        }

        return $this->serializer;
    }

    private function send(string $method, string $path, ?Arrayable $request = null, ?string $class = null)
    {
        $response = $this->getHttpClient()->request(
            $method, $path, $request ? $this->buildRequestOptions($method, $request) : []
        );

        $fileType = $this->guessFileType($response);

        if ($fileType) {
            return $this->buildFile($response, $fileType);
        }

        $data = (string) $response->getBody();

        if (null !== $class && (new \ReflectionClass($class))->isSubclassOf(IterableResponse::class)) {
            $data = '{"items":'.$data.'}';
        }

        if (null === $class) {
            return \json_decode($data, false);
        }

        return $this->createDesrializer()->deserialize($data, $class, 'json');
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
            'body'  => \json_encode($data),
            'headers' => [
                'Content-Type' => 'application/json;charset=UTF-8'
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

    public function buildFile(Response $response, string $type): UploadedFile
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
}
