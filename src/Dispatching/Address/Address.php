<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Address;

use Appwilio\RussianPostSDK\Dispatching\Exceptions\AddressException;

class Address implements AddressInterface
{
    /** @var string */
    private $id;

    /** @var string */
    private $address;

    public function __construct(string $address, ?string $id = null)
    {
        if (!$this->isAddressValid($address)) throw AddressException::incorrectAddress();
        if (empty($id)) $id = $this->generateId($address);

        $this->setAddress($address);
        $this->setId($id);
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id)
    {
        $this->id = $id;
    }

    public function setAddress(string $address)
    {
        $this->address = $address;
    }

    private function isAddressValid(string $address): bool
    {
        $address = trim($address);
        return (bool)(!empty($address));
    }

    private function generateId(string $string): string
    {
        return sha1($string);
    }
}