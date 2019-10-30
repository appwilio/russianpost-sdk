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

namespace Appwilio\RussianPostSDK\Dispatching;

use Psr\Log\NullLogger;
use Psr\Log\LoggerInterface;
use Psr\Log\LoggerAwareInterface;
use GuzzleHttp\ClientInterface;
use Appwilio\RussianPostSDK\Dispatching\Http\ApiClient;
use Appwilio\RussianPostSDK\Dispatching\Http\Authentication;
use Appwilio\RussianPostSDK\Dispatching\Exceptions\UnknownEndpoint;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Orders\Orders;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Services;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Settings\Settings;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Documents\Documents;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\PostOffices\PostOffices;

/**
 * Class DispatchingClient.
 *
 * @property-read  Orders       $orders
 * @property-read  Documents    $documents
 * @property-read  Services     $services
 * @property-read  Settings     $settings
 * @property-read  PostOffices  $postoffices
 */
final class DispatchingClient implements LoggerAwareInterface
{
    private const ENDPOINTS = [
        'orders'      => Orders::class,
        'services'    => Services::class,
        'settings'    => Settings::class,
        'documents'   => Documents::class,
        'postoffices' => PostOffices::class,
    ];

    /** @var ApiClient */
    private $client;

    public function __construct(string $login, string $password, string $token, ClientInterface $httpClient)
    {
        $this->client = new ApiClient(new Authentication($login, $password, $token), $httpClient, new NullLogger());
    }

    public function __get(string $property)
    {
        if (isset(self::ENDPOINTS[$property])) {
            $class = self::ENDPOINTS[$property];

            return new $class($this->client);
        }

        throw new UnknownEndpoint($property);
    }

    /**
     * Sets a logger.
     *
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->client->setLogger($logger);
    }
}
