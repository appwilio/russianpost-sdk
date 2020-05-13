<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Orders\Entites;

use Appwilio\RussianPostSDK\Core\Arrayable;
use Appwilio\RussianPostSDK\Dispatching\DataAware;
use Appwilio\RussianPostSDK\Dispatching\Enum\MailEntryType;

final class CustomsDeclaration implements Arrayable
{
    use DataAware;

    /** @var CustomsDeclarationItem[] */
    private $items;

    public function __construct(MailEntryType $entriesType, string $currency)
    {
        $this->data['entries-type'] = $entriesType;
        $this->data['currency'] = $currency;
    }

    public function addItem(CustomsDeclarationItem $item)
    {
        $this->items[] = $item;

        return $this;
    }

    public function withInvoice(string $number)
    {
        $this->data['with-invoice'] = true;
        $this->data['invoice-number'] = $number;

        return $this;
    }

    public function withCertificate(string $number)
    {
        $this->data['with-certificate'] = true;
        $this->data['certificate-number'] = $number;

        return $this;
    }

    public function withLicense(string $number)
    {
        $this->data['with-license'] = true;
        $this->data['license-number'] = $number;

        return $this;
    }

    public function getCurrency(): string
    {
        return $this->get('currency');
    }

    public function getEntriesType(): MailEntryType
    {
        return new MailEntryType($this->get('entries-type'));
    }

    public function getInvoice(): ?string
    {
        return $this->get('invoice-number');
    }

    public function getCertificate(): ?string
    {
        return $this->get('certificate-number');
    }

    public function getLicense(): ?string
    {
        return $this->get('license-number');
    }

    public function hasInvoice(): bool
    {
        return (bool) $this->get('with-invoice');
    }

    public function hasCertificate(): bool
    {
        return (bool) $this->get('with-certificate');
    }

    public function hasLicense(): bool
    {
        return (bool) $this->get('with-license');
    }

    public function toArray(): array
    {
        foreach ($this->items as $entry) {
            $this->data['customs-entries'][] = $entry->toArray();
        }

        return $this->data;
    }
}
