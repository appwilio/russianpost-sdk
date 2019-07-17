<?php

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Requests;

use Appwilio\RussianPostSDK\Dispatching\Contracts\Arrayable;

final class CalculationRequest implements Arrayable
{
    /** @var array */
    private $data;

    public static function create(string $to, int $mass): self
    {
        return new self(...\func_get_args());
    }

    public function __construct(string $to, int $mass)
    {
        $this->data = [
            'index-to' => $to,
            'mass'     => $mass,
        ];
    }

    public function ofEntriesType(string $entriesType)
    {
        $this->data['entries-type'] = $entriesType;

        return $this;
    }

    public function ofMailCategory(string $mailCategory)
    {
        $this->data['mail-category'] = $mailCategory;

        return $this;
    }

    public function ofMailType(string $mailType)
    {
        $this->data['mail-type'] = $mailType;

        return $this;
    }

    public function dimensions(int $height, int $width, int $length)
    {
        $this->data['dimension'] = \compact('height', 'width', 'length');

        return $this;
    }

    public function fragile(bool $value = true)
    {
        $this->data['fragile'] = $value;

        return $this;
    }

    public function viaCourier(bool $value = true)
    {
        $this->data['courier'] = $value;

        return $this;
    }

    public function withDeclaredValue(int $value)
    {
        $this->data['declared-value'] = $value;

        return $this;
    }

    public function withCompletenessChecking(bool $value = true)
    {
        $this->data['completeness-checking'] = $value;

        return $this;
    }

    public function withSimpleNotice(bool $value = true)
    {
        $this->data['with-simple-notice'] = $value;

        return $this;
    }

    public function withRegisteredNotice(bool $value = true)
    {
        $this->data['with-order-of-notice'] = $value;

        return $this;
    }

    public function withSmsNotice(bool $value = true)
    {
        $this->data['sms-notice-recipient'] = $value;

        return $this;
    }

    public function toArray(): array
    {
        return $this->data;
    }
}
