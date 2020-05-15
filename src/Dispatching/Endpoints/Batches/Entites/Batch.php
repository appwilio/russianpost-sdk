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

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Batches\Entites;

use Appwilio\RussianPostSDK\Dispatching\DataAware;
use Appwilio\RussianPostSDK\Dispatching\Entities\Tariff;
use Appwilio\RussianPostSDK\Dispatching\Enum\BatchStatus;
use Appwilio\RussianPostSDK\Dispatching\Enum\MailCategory;
use Appwilio\RussianPostSDK\Dispatching\Enum\MailRank;
use Appwilio\RussianPostSDK\Dispatching\Enum\MailType;
use Appwilio\RussianPostSDK\Dispatching\Enum\NotifyCategory;
use Appwilio\RussianPostSDK\Dispatching\Enum\PaymentMethodType;
use Appwilio\RussianPostSDK\Dispatching\Enum\TransportType;
use Appwilio\RussianPostSDK\Dispatching\Instantiator;

final class Batch
{
    use DataAware;

    /**
     * Имя (номер) партии.
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->get('batch-name');
    }

    /**
     * Количество заказов в партии.
     *
     * @return int
     */
    public function getShipmentCount(): int
    {
        return (int) $this->get('shipment-count');
    }

    /**
     * Общий вес в граммах.
     *
     * @return int
     */
    public function getShipmentMass()
    {
        return (int) $this->get('shipment-mass');
    }

    /**
     * Статус партии.
     *
     * @return BatchStatus
     */
    public function getStatus(): BatchStatus
    {
        return new BatchStatus($this->get('batch-status'));
    }

    /**
     * Дата обновления статуса партии.
     *
     * @return \DateTimeInterface
     */
    public function getStatusDate(): \DateTimeInterface
    {
        return \DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.???P', $this->get('batch-status-date'));
    }

    /**
     * Идентификатор подразделения.
     *
     * @return string
     */
    public function getBranchName(): string
    {
        return $this->get('branch-name');
    }

    /**
     * Виды РПО в партии.
     *
     * @return MailType[]
     */
    public function getMailTypes()
    {
        return $this->get('combined-batch-mail-types');
    }

    /**
     * Плата за услугу "Курьерский сбор".
     *
     * @return Tariff
     */
    public function getCourierCallRate(): Tariff
    {
        return Instantiator::instantiate(Tariff::class, [
            'rate' => $this->get('courier-call-rate-wo-vat'),
            'vat'  => $this->get('courier-call-rate-with-vat') - $this->get('courier-call-rate-wo-vat'),
        ]);
    }

    /**
     * Статусы заявки на вызов курьера.
     *
     * @return mixed|null
     */
    public function getCourierOrderStatuses()
    {
        return $this->get('courier-order-statuses');
    }

    /**
     * Способ оплаты уведомления о вручении РПО.
     *
     * @return string
     */
    public function getDeliveryNoticePaymentMethod()
    {
        return $this->get('delivery-notice-payment-method');
    }

    /**
     * Признак международной почты.
     *
     * @return bool
     */
    public function isInternational(): bool
    {
        return $this->get('international', 'bool');
    }

    /**
     * Номер документа для сдачи партии.
     *
     * @return int
     */
    public function getListNumber(): int
    {
        return (int) $this->get('list-number');
    }

    /**
     * Дата документа для сдачи партии (yyyy-MM-dd).
     *
     * @return \DateTimeInterface
     */
    public function getListNumberDate(): \DateTimeInterface
    {
        return \DateTimeImmutable::createFromFormat('Y-m-d', $this->get('list-number-date'));
    }

    /**
     * Категория РПО.
     *
     * @return MailCategory
     */
    public function getMailCategory(): MailCategory
    {
        return new MailCategory($this->get('mail-category'));
    }

    /**
     * Категория РПО (текст).
     *
     * @return string
     */
    public function getMailCategoryText()
    {
        // FIXME
        return $this->get('mail-category-text');
    }

    /**
     * Разряд писем в партии.
     *
     * @return MailRank
     */
    public function getMailRank(): MailRank
    {
        return new MailRank($this->get('mail-rank'));
    }

    /**
     * Вид РПО.
     *
     * @return MailType
     */
    public function getMailType(): MailType
    {
        return new MailType($this->get('mail-type'));
    }

    /**
     * Вид РПО (текст).
     *
     * @return string
     */
    public function getMailTypeText()
    {
        // FIXME
        return $this->get('mail-type-text');
    }

    /**
     * Способ оплаты.
     *
     * @return PaymentMethodType
     */
    public function getPaymentMethod(): PaymentMethodType
    {
        return new PaymentMethodType($this->get('payment-method'));
    }

    /**
     * Способ оплаты уведомлений.
     *
     * @return PaymentMethodType
     */
    public function getNoticePaymentMethod(): PaymentMethodType
    {
        return new PaymentMethodType($this->get('notice-payment-method'));
    }

    /**
     * Коды отметок внутренних и международных отправлений.
     *
     * @return string[]
     */
    public function getPostmarks()
    {
        // FIXME: сделать enum
        return $this->get('postmarks');
    }

    /**
     * Адрес места приема.
     *
     * @return string
     */
    public function getPostofficeAddress(): string
    {
        return $this->get('postoffice-address');
    }

    /**
     * Индекс места приема.
     *
     * @return string
     */
    public function getPostofficeCode(): string
    {
        return $this->get('postoffice-code');
    }

    /**
     * Наименование места приема.
     *
     * @return string
     */
    public function getPostofficeName(): string
    {
        return $this->get('postoffice-name');
    }

    /**
     * Плата за авиа пересылку.
     *
     * @return Tariff
     */
    public function getShipmentAviaRate(): Tariff
    {
        return Instantiator::instantiate(Tariff::class, [
            'rate' => $this->get('shipment-avia-rate-sum'),
            'vat'  => $this->get('shipment-avia-rate-vat-sum'),
        ]);
    }

    /**
     * Плата за проверку комплектности.
     *
     * @return Tariff
     */
    public function getShipmentCompletenessCheckingRateSum(): Tariff
    {
        return Instantiator::instantiate(Tariff::class, [
            'rate' => $this->get('shipment-completeness-checking-rate-sum'),
            'vat'  => $this->get('shipment-completeness-checking-rate-vat-sum'),
        ]);
    }

    /**
     * Плата за проверку вложений.
     *
     * @return Tariff
     */
    public function getShipmentContentsCheckingRate(): Tariff
    {
        return Instantiator::instantiate(Tariff::class, [
            'rate' => $this->get('shipment-contents-checking-rate-sum'),
            'vat'  => $this->get('shipment-contents-checking-rate-vat-sum'),
        ]);
    }

    /**
     * Плата за наземную пересылку.
     *
     * @return Tariff
     */
    public function getShipmentGroundRateSum(): Tariff
    {
        return Instantiator::instantiate(Tariff::class, [
            'rate' => $this->get('shipment-ground-rate-sum'),
            'vat'  => $this->get('shipment-ground-rate-vat-sum'),
        ]);
    }

    /**
     * Плата за объявленную ценность.
     *
     * @return Tariff
     */
    public function getShipmentInsureRateSum(): Tariff
    {
        return Instantiator::instantiate(Tariff::class, [
            'rate' => $this->get('shipment-insure-rate-sum'),
            'vat'  => $this->get('shipment-insure-rate-vat-sum'),
        ]);
    }

    /**
     * Плата за опись вложения.
     *
     * @return Tariff
     */
    public function getShipmentInventoryRateSum(): Tariff
    {
        return Instantiator::instantiate(Tariff::class, [
            'rate' => $this->get('shipment-inventory-rate-sum'),
            'vat'  => $this->get('shipment-inventory-rate-vat-sum'),
        ]);
    }

    /**
     * Плата за пересылку.
     *
     * @return Tariff
     */
    public function getShipmentMassRateSum(): Tariff
    {
        return Instantiator::instantiate(Tariff::class, [
            'rate' => $this->get('shipment-mass-rate-sum'),
            'vat'  => $this->get('shipment-mass-rate-vat-sum'),
        ]);
    }

    /**
     * Плата за уведомление о вручении.
     *
     * @return Tariff
     */
    public function getShipmentNoticeRateSum(): Tariff
    {
        return Instantiator::instantiate(Tariff::class, [
            'rate' => $this->get('shipment-notice-rate-sum'),
            'vat'  => $this->get('shipment-notice-rate-vat-sum'),
        ]);
    }

    /**
     * Плата за смс нотификацию в копейках.
     *
     * @return Tariff
     */
    public function getShipmentSmsRateSum(): Tariff
    {
        return Instantiator::instantiate(Tariff::class, [
            'rate' => $this->get('shipment-sms-rate-sum'),
            'vat'  => $this->get('shipment-sms-rate-vat-sum'),
        ]);
    }

    /**
     * Категория уведомления о вручении РПО.
     *
     * @return NotifyCategory
     */
    public function getShippingNoticeType(): NotifyCategory
    {
        return new NotifyCategory($this->get('shipping-notice-type'));
    }

    /**
     * Вид транспортировки.
     *
     * @return TransportType
     */
    public function getTransportType(): TransportType
    {
        return new TransportType($this->get('transport-type'));
    }

    /**
     * Признак использования онлайн-баланса.
     *
     * @return bool
     */
    public function isOnlineBalanceUsed(): bool
    {
        return $this->get('use-online-balance', 'bool');
    }

    /**
     * Без указания массы.
     *
     * @return bool
     */
    public function isWithoutMass(): bool
    {
        return $this->get('wo-mass', 'bool');
    }
}
