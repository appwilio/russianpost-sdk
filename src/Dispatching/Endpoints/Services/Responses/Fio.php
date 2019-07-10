<?php

declare(strict_types = 1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Responses;

use JMS\Serializer\Annotation AS JMS;

final class Fio
{
    /**
     * Коды качества нормализации ФИО
     *
     * @see https://otpravka.pochta.ru/specification#/enums-clean-fio-quality
     */
    public const QUALITY_EDITED = 'EDITED';
    public const QUALITY_NOT_SURE = 'NOT_SURE';
    public const QUALITY_CONFIRMED_MANUALLY = 'CONFIRMED_MANUALLY';

    /**
     * @JMS\Type("string")
     * @var string
     */
    private $id;

    /**
     * @JMS\SerializedName("name")
     * @JMS\Type("string")
     * @var string
     */
    private $firstName;

    /**
     * @JMS\SerializedName("middle-name")
     * @JMS\Type("string")
     * @var string
     */
    private $middleName;

    /**
     * @JMS\SerializedName("surname")
     * @JMS\Type("string")
     * @var string
     */
    private $lastName;

    /**
     * @JMS\SerializedName("original-fio")
     * @JMS\Type("string")
     * @var string
     */
    private $originalFio;

    /**
     * @JMS\SerializedName("quality-code")
     * @JMS\Type("string")
     * @var string
     */
    private $qualityCode;

    /**
     * @JMS\Type("bool")
     * @var bool
     */
    private $valid;

    public function getId(): string
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getMiddleName(): string
    {
        return $this->middleName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getOriginalFio(): string
    {
        return $this->originalFio;
    }

    public function getQualityCode(): string
    {
        return $this->qualityCode;
    }

    public function isUseful(): bool
    {
        return $this->valid;
    }
}
