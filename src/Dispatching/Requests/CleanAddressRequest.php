<?php

namespace Appwilio\RussianPostSDK\Dispatching\Requests;

use Appwilio\RussianPostSDK\Dispatching\Address\AddressInterface;

class CleanAddressRequest implements RequestInterface
{
    public const ENDPOINT = 'https://otpravka-api.pochta.ru/1.0/clean/address';
    public const METHOD = 'POST';

    /** @var array */
    private $addresses = [];

    public function getUrl(): string
    {
        return self::ENDPOINT;
    }

    public function getMethod(): string
    {
        return self::METHOD;
    }

    public function getBodyArray(): array
    {
        return $this->addresses;
    }


    public function addAddress(AddressInterface $address)
    {
        $this->addresses[] = [
            "id"               => $address->getId(),
            "original-address" => $address->getAddress()
        ];
    }


}
