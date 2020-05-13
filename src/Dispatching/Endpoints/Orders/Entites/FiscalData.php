<?php

/**
 * This file is part of RussianPost SDK package.
 *
 * © Appwilio (http://appwilio.com), greabock (https://github.com/greabock), JhaoDa (https://github.com/jhaoda)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Orders\Entites;

use Appwilio\RussianPostSDK\Core\Arrayable;
use Appwilio\RussianPostSDK\Dispatching\DataAware;

final class FiscalData implements Arrayable
{
    use DataAware;

    public function __construct(?string $email, ?string $phone, ?string $name, ?string $inn, ?int $prepaid)
    {
        $this->data = [
            'customer-email' => $email,
            'customer-inn' => $inn,
            'customer-name' => $name,
            'customer-phone' => $phone ? (int) \preg_replace('~\D+~', '', $phone) : null,
            'payment-amount' => $prepaid,
        ];
    }

    public function getCustomerEmail(): ?string
    {
        return $this->get('customer-email');
    }

    public function getCustomerInn(): ?string
    {
        return $this->get('customer-inn');
    }

    public function getCustomerName(): ?string
    {
        return $this->get('customer-name');
    }

    public function getCustomerPhone(): ?string
    {
        return $this->get('customer-phone', 'string');
    }

    public function getPrepaidAmount(): ?int
    {
        return $this->get('payment-amount');
    }

    public function toArray(): array
    {
        return $this->data;
    }
}
