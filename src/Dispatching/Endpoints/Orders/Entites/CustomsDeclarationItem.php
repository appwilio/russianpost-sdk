<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Orders\Entites;

use Appwilio\RussianPostSDK\Dispatching\DataAware;
use Appwilio\RussianPostSDK\Dispatching\Contracts\Arrayable;

final class CustomsDeclarationItem implements Arrayable
{
    use DataAware;

    public function __construct(
        string $description,
        int $quantity,
        string $country,
        string $tnvedCode,
        int $value = null,
        int $weight = null
    ) {
        $this->data['description'] = $description;
        $this->data['amount'] = $quantity;
        $this->data['country-code'] = $country;
        $this->data['tnved-code'] = $tnvedCode;
        $this->data['value'] = $value;
        $this->data['weight'] = $weight;
    }

    public function getDescription(): ?string
    {
        return $this->get('description');
    }

    public function getQuantity(): ?int
    {
        return $this->get('amount');
    }

    public function getCountryCode(): ?int
    {
        return $this->get('country-code');
    }

    public function getValue(): ?int
    {
        return $this->get('value');
    }

    public function getWeight(): ?int
    {
        return $this->get('weight');
    }

    public function getTnvedCode(): ?string
    {
        return $this->get('tnved-code');
    }
}
