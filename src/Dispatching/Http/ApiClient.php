<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Http;

use GuzzleHttp\Client as HttpClient;
use JMS\Serializer\Handler\HandlerRegistryInterface;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;

final class ApiClient
{
    private const API_URL = 'https://otpravka-api.pochta.ru/1.0';

    private const COMMON_HEADERS = [
        'Accept' => 'application/json;charset=UTF-8'
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

    public function get(string $path, ?ApiRequest $request = null, ?string $class = null)
    {
        return $this->send('GET', ...\func_get_args());
    }

    public function post(string $path, ApiRequest $request, ?string $class = null)
    {
        return $this->send('POST', ...\func_get_args());
    }

    public function delete(string $path, ApiRequest $request, ?string $class = null)
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

    private function send(string $method, string $path, ?ApiRequest $request, ?string $class = null)
    {
        $response = $this->getHttpClient()->request(
            $method, $path, $request ? $this->buildRequestOptions($method, $request) : []
        );

        //Sometimes $response is unnamed collection
        //Need to wrap up response in to "body" for correct deserialization
        //$data = '{"body": ' . (string) $response->getBody() . '}';

        $data = (string) $response;

        return $this->createDesrializer()->deserialize($data, $class, 'json');
    }

    private function buildRequestOptions(string $method, ApiRequest $request): array
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
}
