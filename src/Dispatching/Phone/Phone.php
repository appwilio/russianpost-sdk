<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Phone;

use Appwilio\RussianPostSDK\Dispatching\Exceptions\PhoneException;

class Phone
{
    /** @var string */
    private $id;

    /** @var string */
    private $phone;

    /** @var string */
    private $area;

    /** @var string */
    private $place;

    /** @var string */
    private $region;

    public function __construct(string $phone, ?string $id = null, ?string $region = null, ?string $area = null, ?string $place = null)
    {
        if (!$this->isPhoneValid($phone)) {
            throw PhoneException::incorrectPhone();
        }

        if (empty($id)) {
            $id = $this->generateId($phone);
        }

        $this->setPhone($phone);
        $this->setId($id);
        $this->region = $region ?? "";
        $this->area = $area ?? "";
        $this->place = $place ?? "";
    }

    public function getArea(): string
    {
        return $this->phone;
    }

    public function getPlace(): string
    {
        return $this->place;
    }

    public function getRegion(): string
    {
        return $this->region;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id)
    {
        $this->id = $id;
    }

    public function setPhone(string $phone)
    {
        $this->phone = $phone;
    }

    private function isPhoneValid(string $phone): bool
    {
        $phone = trim($phone);
        return (bool)(!empty($phone));
    }

    private function generateId(string $string): string
    {
        return sha1($string);
    }

}