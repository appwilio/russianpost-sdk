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

use Appwilio\RussianPostSDK\Dispatching\Contracts\Arrayable;

final class OrderItem implements Arrayable
{
    public const VAT_NO = -1;
    public const VAT_0 = 0;
    public const VAT_10 = 10;
    public const VAT_20 = 20;

    /** @var array */
    private $data;

    public static function create(
        string $title,
        int $quantity,
        int $price,
        ?string $code = null,
        ?string $article = null
    ): self {
        return new self(...\func_get_args());
    }

    public function __construct(string $description, int $quantity, ?int $price = null, ?string $code = null, ?string $article = null)
    {
        $this->data['description'] = $description;
        $this->data['quantity'] = $quantity;
        $this->data['value'] = $price;
        $this->data['code'] = $code;
        $this->data['item-number'] = $article;
    }

    public function bySupplier(string $inn, string $name, string $phone)
    {
        $this->data['supplier-inn'] = $inn;
        $this->data['supplier-name'] = $name;
        $this->data['supplier-phone'] = $phone;

        return $this;
    }

    public function paymentMode(PaymentMode54FZ $mode)
    {
        $this->data['payattr'] = $mode;

        return $this;
    }

    public function paymentSubject(PaymentSubject54FZ $subject)
    {
        $this->data['lineattr'] = $subject;

        return $this;
    }

    public function withCustomsDeclarationNumber(string $number)
    {
        $this->data['customs-declaration-number'] = $number;

        return $this;
    }

    public function withVAT(int $vat)
    {
        $this->data['vat-rate'] = $vat;

        return $this;
    }

    public function withInshurance(int $value)
    {
        $this->data['insr-value'] = $value;

        return $this;
    }

    public function withExcise(int $value)
    {
        $this->data['excise'] = $value;

        return $this;
    }

    public function toArray(): array
    {
        return $this->data;
    }
}
