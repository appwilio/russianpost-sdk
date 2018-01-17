<?php

namespace Appwilio\RussianPostSDK\Dispatching\Requests;

class CleanPhoneRequest
{
    public const ENDPOINT = 'https://otpravka-api.pochta.ru/1.0/clean/phone';
    
    /** @var string */
    private $phone;

    public function __construct(iterable $phone)
    {
        $this->phone = $phone;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getId(): string
    {
        return sha1($this->phone);
    }
}
