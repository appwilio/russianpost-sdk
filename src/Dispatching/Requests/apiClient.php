<?php

namespace Appwilio\RussianPostSDK\Dispatching\Requests;

use GuzzleHttp\Client as GuzzleClient;
use Appwilio\RussianPostSDK\Dispatching\Responses\CalculateResponse;
use Appwilio\RussianPostSDK\Dispatching\Responses\CleanAddressCollectionResponse;
use Appwilio\RussianPostSDK\Dispatching\Responses\CleanPhoneResponse;
use JMS\Serializer\SerializerBuilder;

class apiClient
{
    /** @var string */
    private $auth;

    /** @var GuzzleClient */
    private $httpClient;

    protected $map = [
        CleanAddressRequest::class => CleanAddressCollectionResponse::class,
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
            $this->httpClient = new GuzzleClient([
                'headers' => [
                    'Authorization'        => 'AccessToken ' . $this->auth->token,
                    'Content-Type'         => 'application/json',
                    'Accept'               => 'application/json;charset=UTF-8',
                    'X-User-Authorization' => 'Basic ' . $this->auth->basicAuth(),
                ]
            ]);
        }
        return $this->httpClient;
    }

    public function send(RequestInterface $request)
    {
        $response = ($this->getHttpClient())->request(
            $request->getMethod(),
            $request->getUrl(),
            [
                'body'   => json_encode($request->getBodyArray()),
                'stream' => true
            ]
        );

        $stream = $response->getBody();
        $result = "";
        while (!$stream->eof()) {
            $result .= $stream->read(1024);
        }

        //Sometimes $result is unnamed collection
        //Need to wrap up result in to "body" for correct deserialization
        $result = '{ "body": '.(string)$result.' }';

        $serializer = SerializerBuilder::create()->build();
        return $serializer->deserialize($result, $this->map[get_class($request)], 'json');
    }

}