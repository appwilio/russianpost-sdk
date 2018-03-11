<?php

namespace Appwilio\RussianPostSDK\Dispatching\Requests;

use Doctrine\Common\Annotations\AnnotationRegistry;
use GuzzleHttp\Client as GuzzleClient;
use Appwilio\RussianPostSDK\Dispatching\Responses\CalculateResponse;
use Appwilio\RussianPostSDK\Dispatching\Responses\CleanAddressCollectionResponse;
use Appwilio\RussianPostSDK\Dispatching\Responses\CleanPhoneCollectionResponse;
use Appwilio\RussianPostSDK\Dispatching\Responses\CleanPhoneResponse;
use JMS\Serializer\SerializerBuilder;

class ApiClient
{
    /** @var string */
    private $auth;

    /** @var GuzzleClient */
    private $httpClient;

    private const COMMON_HEADERS = [
        'Content-Type' => 'application/json',
        'Accept'       => 'application/json;charset=UTF-8'
    ];

    protected $map = [
        CleanAddressRequest::class => CleanAddressCollectionResponse::class,
        CleanPhoneRequest::class   => CleanPhoneCollectionResponse::class,
        CleanPhoneRequest::class   => CleanPhoneResponse::class,
        CalculateRequest::class    => CalculateResponse::class,
    ];

    public function __construct(AuthorizationHeader $authorizationHeader)
    {
        $this->auth = $authorizationHeader;
    }

    protected function getHttpClient(): GuzzleClient
    {
        if (!$this->httpClient) {
            $this->httpClient = new GuzzleClient(
                [
                    'headers' => array_merge(static::COMMON_HEADERS, $this->auth->buildHeaders())
                ]
            );
        }
        return $this->httpClient;
    }

    public function send(RequestInterface $request)
    {
        $response = ($this->getHttpClient())->request(
            $request->getMethod(),
            $request->getUrl(),
            [
                'body' => json_encode($request->getBodyArray()),
            ]
        );

        //Sometimes $result is unnamed collection
        //Need to wrap up result in to "body" for correct deserialization
        $result = '{ "body": ' . (string)$response->getBody() . ' }';

        /**
         * I have bug from loaded
         * Doctrine\Common\Annotations\AnnotationException : [Semantical Error] The annotation "@JMS\Serializer\Annotation\Type"
         * in property ... does not exist, or could not be auto-loaded.
         * Solution @see https://github.com/symfony/symfony/issues/25555
         */
        AnnotationRegistry::registerLoader('class_exists');

        $serializer = SerializerBuilder::create()->build();
        return $serializer->deserialize($result, $this->map[get_class($request)], 'json');
    }

}