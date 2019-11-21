<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Orders\Requests;

use Appwilio\RussianPostSDK\Dispatching\DataAware;
use Appwilio\RussianPostSDK\Dispatching\Entities\Address;
use Appwilio\RussianPostSDK\Dispatching\Contracts\Arrayable;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Orders\Entites\Order;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Orders\Entites\OrderItem;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Orders\Entites\Recipient;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Orders\Entites\CustomsDeclaration;

final class OrderRequest implements Arrayable
{
    use DataAware;

    private const RUSSIAN_POSTAL_CODE = '~\d{6}~';

    /** @var Address */
    private $address;

    /** @var OrderItem[] */
    private $items = [];

    /** @var CustomsDeclaration|null */
    private $declaration;

    /** @var Recipient */
    private $recipient;

    public static function create(
        string $id,
        string $type,
        string $category,
        int $weight,
        Address $address,
        Recipient $recipient
    ) {
        return new self(...\func_get_args());
    }

    public static function fromOrder(Order $order)
    {
        
    }

    public function __construct(
        string $number,
        string $mailType,
        string $mailCategory,
        int $weight,
        Address $address,
        Recipient $recipient
    ) {
        $this->data = [
            'mass'          => $weight,
            'order-num'     => $number,
            'mail-type'     => $mailType,
            'mail-category' => $mailCategory,
        ];

        $this->address = $address;
        $this->recipient = $recipient;
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

    public function addItem(OrderItem $item): void
    {
        $this->items[] = $item;
    }

    public function withCustomsDeclaration(CustomsDeclaration $declaration)
    {
        $this->declaration = $declaration;

        return $this;
    }

    public function withInshurance(int $value)
    {
        $this->data['insr-value'] = $value;

        return $this;
    }

    public function withInventory(bool $value)
    {
        $this->data['inventory'] = $value;

        return $this;
    }

    public function withDeclaredValue(int $value)
    {
        $this->data['payment'] = $value;

        return $this;
    }

    public function withCompletenessChecking(bool $value = true)
    {
        $this->data['completeness-checking'] = $value;

        return $this;
    }

    public function withVsd(bool $value = true)
    {
        $this->data['vsd'] = $value;

        return $this;
    }

    public function withElectronicNotice(bool $value = true)
    {
        $this->data['with-electronic-notice'] = $value;

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

    public function withoutMailRank(bool $value = true)
    {
        $this->data['wo-mail-rank'] = $value;

        return $this;
    }

    public function toArray(): array
    {
        $this->data['custom-declaration'] = $this->declaration ? $this->declaration->toArray() : null;

        if (\count($this->items) > 0) {
            $this->data['goods'] = ['items'];

            foreach ($this->items as $item) {
                $this->data['goods']['items'][] = $item->toArray();
            }
        }

        $this->data = \array_merge($this->data, $this->recipient->toArray());
        $this->data = \array_merge($this->data, \iterator_to_array($this->convertAddress($this->address)));

        return [$this->data];
    }

    private function convertAddress(Address $address): \Generator
    {
        foreach ($address->toArray() as $key => $value) {
            if ($key === 'index' && !\preg_match(self::RUSSIAN_POSTAL_CODE, $value)) {
                yield 'str-index-to' => $value;
            } else if ($key === 'mail-direct') {
                yield $key => $value;
            } else {
                yield "{$key}-to" => $value;
            }
        }
    }
}
