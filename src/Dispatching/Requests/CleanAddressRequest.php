<?php

namespace Appwilio\RussianPostSDK\Dispatching\Requests;

class CleanAddressRequest
{
    public const ENDPOINT = 'https://otpravka-api.pochta.ru/1.0/clean/address';

    /** @var string */
    private $address;

    public function __construct(iterable $address)
    {
        $this->address = $address;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getId(): string
    {
        return sha1($this->address);
    }
}
