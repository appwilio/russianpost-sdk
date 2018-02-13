<?php

namespace Appwilio\RussianPostSDK\Dispatching\Address;

interface AddressInterface
{
    public function setAddress(string $address);

    public function setId(string $id);

    public function getAddress(): string;

    public function getId(): string;
}