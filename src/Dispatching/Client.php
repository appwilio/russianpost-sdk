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

use Appwilio\RussianPostSDK\Dispatching\Address\Address;
use Appwilio\RussianPostSDK\Dispatching\Phone\Phone;
use Appwilio\RussianPostSDK\Dispatching\Requests\ApiClient;
use Appwilio\RussianPostSDK\Dispatching\Requests\AuthorizationHeader;
use Appwilio\RussianPostSDK\Dispatching\Requests\CleanAddressRequest;
use Appwilio\RussianPostSDK\Dispatching\Requests\CleanPhoneRequest;
use Appwilio\RussianPostSDK\Dispatching\Responses\CleanAddressCollectionResponse;
use Appwilio\RussianPostSDK\Dispatching\Responses\CleanPhoneCollectionResponse;

class Client
{
    protected const API_URL = 'https://otpravka-api.pochta.ru/1.0/';

    /** @var ApiClient */
    private $client;

    public function __construct(string $login, string $password, string $token)
    {
        $auth = new AuthorizationHeader($login, $password, $token);
        $this->client = new ApiClient($auth);
    }

    /**
     * @param string $address
     * @param null|string $id
     * @return CleanAddressCollectionResponse
     * @throws Exceptions\AddressException
     */
    public function getCleanAddress(
        string $address,
        ?string $id = null
    ): CleanAddressCollectionResponse
    {
        $cleanAddressRequest = new CleanAddressRequest();
        $cleanAddressRequest->addAddress(new Address($address, $id));

        return $this->client->send($cleanAddressRequest);
    }

    /**
     * @param string $phone
     * @param null|string $id
     * @return CleanPhoneCollectionResponse
     * @throws Exceptions\PhoneException
     */
    public function getCleanPhone(
        string $phone,
        ?string $id = null,
        ?string $area = null,
        ?string $place = null,
        ?string $region = null
    ): CleanPhoneCollectionResponse
    {
        $cleanPhoneRequest = new CleanPhoneRequest();
        $cleanPhoneRequest->addPhone(new Phone($phone, $id, $region, $area, $place));

        return $this->client->send($cleanPhoneRequest);
    }
}
