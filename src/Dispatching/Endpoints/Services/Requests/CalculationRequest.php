<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Requests;

use Appwilio\RussianPostSDK\Dispatching\Enum\MailType;
use Appwilio\RussianPostSDK\Dispatching\Enum\MailCategory;
use Appwilio\RussianPostSDK\Dispatching\Enum\MailEntryType;
use Appwilio\RussianPostSDK\Dispatching\Contracts\Arrayable;
use Appwilio\RussianPostSDK\Dispatching\Entities\CommonOrder;

final class CalculationRequest implements Arrayable
{
    use CommonOrder;

    public static function create(string $to, int $weight): self
    {
        return new self(...\func_get_args());
    }

    public function __construct(string $to, int $weight)
    {
        $this->data = [
            'index-to' => $to,
            'mass'     => $weight,
        ];
    }

    public function ofEntriesType(MailEntryType $entriesType)
    {
        $this->data['entries-type'] = $entriesType;

        return $this;
    }

    public function ofMailCategory(MailCategory $mailCategory)
    {
        $this->data['mail-category'] = $mailCategory;

        return $this;
    }

    public function ofMailType(MailType $mailType)
    {
        $this->data['mail-type'] = $mailType;

        return $this;
    }

    public function withDeclaredValue(int $value)
    {
        $this->data['declared-value'] = $value;

        return $this;
    }

    public function withContentChecking(bool $value = true)
    {
        $this->data['contents-checking'] = $value;

        return $this;
    }

    public function withFitting(bool $value = true)
    {
        $this->data['with-fitting'] = $value;

        return $this;
    }

    public function toArray(): array
    {
        if ($this->data['mail-type']->equals(MailType::ECOM())) {
            $this->data['delivery-point-index'] = $this->data['index-to'];

            unset($this->data['index-to']);
        }

        return $this->data;
    }

}
