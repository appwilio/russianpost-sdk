<?php

namespace Appwilio\RussianPostSDK\Dispatching\Requests;

use Appwilio\RussianPostSDK\Dispatching\Phone\Phone;

class CleanPhoneRequest implements RequestInterface
{
    public const ENDPOINT = 'https://otpravka-api.pochta.ru/1.0/clean/phone';
    public const METHOD = 'POST';

    /** @var array */
    private $phones = [];

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
        return $this->phones;
    }

    public function addPhone(Phone $phone)
    {
        $newPhone = [
            "id"             => $phone->getId(),
            "original-phone" => $phone->getPhone()
        ];

        if (!empty($phone->getArea())) {
            $newPhone["area"] = $phone->getArea();
        }

        if (!empty($phone->getPlace())) {
            $newPhone["place"] = $phone->getPlace();
        }

        if (!empty($phone->getRegion())) {
            $newPhone["region"] = $phone->getRegion();
        }

        $this->phones[] = $newPhone;
    }

}
