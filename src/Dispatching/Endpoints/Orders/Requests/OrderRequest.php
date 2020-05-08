<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Orders\Requests;

use Appwilio\RussianPostSDK\Dispatching\Enum\MailType;
use Appwilio\RussianPostSDK\Dispatching\Entities\Address;
use Appwilio\RussianPostSDK\Dispatching\Enum\MailCategory;
use Appwilio\RussianPostSDK\Dispatching\Contracts\Arrayable;
use Appwilio\RussianPostSDK\Dispatching\Entities\CommonOrder;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Orders\Entites\Order;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Orders\Entites\EcomData;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Orders\Entites\OrderItem;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Orders\Entites\Recipient;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Orders\Entites\FiscalData;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Orders\Entites\CustomsDeclaration;

final class OrderRequest implements Arrayable
{
    use CommonOrder;

    private const RUSSIAN_POSTAL_CODE = '~\d{6}~';

    private $data;

    /** @var Address */
    private $address;

    /** @var OrderItem[] */
    private $items = [];

    /** @var CustomsDeclaration|null */
    private $declaration;

    /** @var EcomData */
    private $ecomData;

    /** @var FiscalData */
    private $fiscalData;

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
        MailType $mailType,
        MailCategory $mailCategory,
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

    public function addItem(OrderItem $item): void
    {
        $this->items[] = $item;
    }

    public function withCustomsDeclaration(CustomsDeclaration $declaration)
    {
        $this->declaration = $declaration;

        return $this;
    }

    public function withEcomData(EcomData $data)
    {
        $this->ecomData = $data;

        return $this;
    }

    public function withFiscalData(FiscalData $data)
    {
        $this->fiscalData = $data;

        return $this;
    }

    public function withInshurance(int $value)
    {
        $this->data['insr-value'] = $value;

        return $this;
    }

    public function withDeclaredValue(int $value)
    {
        $this->data['payment'] = $value;

        return $this;
    }

    public function withoutMailRank(bool $value = true)
    {
        $this->data['wo-mail-rank'] = $value;

        return $this;
    }

    public function toArray(): array
    {
        $this->data['ecom-data'] = $this->ecomData ? $this->ecomData->toArray() : null;
        $this->data['fiscal-data'] = $this->fiscalData ? $this->fiscalData->toArray() : null;
        $this->data['custom-declaration'] = $this->declaration ? $this->declaration->toArray() : null;

        if (\count($this->items) > 0) {
            $this->data['goods'] = ['items'];

            foreach ($this->items as $item) {
                $this->data['goods']['items'][] = $item->toArray();
            }
        }

        $this->data = \array_merge(
            $this->data,
            $this->recipient->toArray(),
            \iterator_to_array($this->convertAddress($this->address))
        );

        return [$this->data];
    }

    private function convertAddress(Address $address): \Generator
    {
        foreach ($address->toArray() as $key => $value) {
            if ($key === 'index' && !\preg_match(self::RUSSIAN_POSTAL_CODE, $value)) {
                yield 'str-index-to' => $value;
            } elseif ($key === 'mail-direct') {
                yield $key => $value;
            } else {
                yield "{$key}-to" => $value;
            }
        }
    }
}
