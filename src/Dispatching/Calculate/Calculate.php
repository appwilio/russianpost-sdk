<?php
/**
 * This file is part of russianpost-sdk package.
 *
 * @author Anton Kartsev <anton@alarm.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Calculate;

use Appwilio\RussianPostSDK\Dispatching\Exceptions\CalculateException;

class Calculate implements CalculateInterface
{
    /**
     * Default request parameters @see https://otpravka.pochta.ru/specification#/nogroup-rate_calculate
     */
    protected $courier;
    protected $declaredValue;
    protected $height;
    protected $length;
    protected $width;
    protected $fragile;
    protected $indexFrom;
    protected $indexTo;
    protected $mailCategory;
    protected $mailType;
    protected $weight;
    protected $paymentMethod;
    protected $withOrderOfNotice;
    protected $withSimpleNotice;

    /**
     * Calculate constructor.
     *
     * @param \Appwilio\RussianPostSDK\Dispatching\Calculate\MailCategory $category
     * @param \Appwilio\RussianPostSDK\Dispatching\Calculate\MailType     $type
     * @param int                                                         $weight
     * @param bool                                                        $withOrderOfNotice
     * @param bool                                                        $withSimpleNotice
     */
    public function __construct(
        MailCategory $category,
        MailType $type,
        int $weight = 1000,
        bool $withOrderOfNotice = true,
        bool $withSimpleNotice = true
    ) {
        $this->mailCategory = $category;
        $this->mailType = $type;
        $this->weight = $weight;
        $this->withOrderOfNotice = $withOrderOfNotice;
        $this->withSimpleNotice = $withSimpleNotice;
    }


    /**
     * @return bool
     */
    public function isCourier(): ?bool
    {
        return $this->courier;
    }

    /**
     * @param bool|null $courier
     *
     * @return self
     */
    public function setCourier(?bool $courier): self
    {
        $this->courier = $courier;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getDeclaredValue(): ?int
    {
        return $this->declaredValue;
    }

    /**
     * @param int|null $declaredValue
     *
     * @return self
     */
    public function setDeclaredValue(?int $declaredValue): self
    {
        $this->declaredValue = $declaredValue;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getHeight(): ?int
    {
        return $this->height;
    }

    /**
     * @param int|null $height
     *
     * @return self
     */
    public function setHeight(?int $height): self
    {
        $this->height = $height;

        return $this;
    }

    /**
     * @return int|null
     *
     * @return self
     */
    public function getLength(): ?int
    {
        return $this->length;
    }

    /**
     * @param int|null $length
     *
     * @return self
     */
    public function setLength(?int $length): self
    {
        $this->length = $length;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getWidth(): ?int
    {
        return $this->width;
    }

    /**
     * @param int|null $width
     *
     * @return self
     */
    public function setWidth(?int $width): self
    {
        $this->width = $width;

        return $this;
    }

    /**
     * @return bool
     */
    public function isFragile(): ?bool
    {
        return $this->fragile;
    }

    /**
     * @param bool $fragile
     *
     * @return self
     */
    public function setFragile(?bool $fragile): self
    {
        $this->fragile = $fragile;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFrom(): ?string
    {
        return $this->indexFrom;
    }

    /**
     * @param string|null $indexFrom
     *
     * @return self
     * @throws \Appwilio\RussianPostSDK\Dispatching\Exceptions\CalculateException
     */
    public function from(string $indexFrom): self
    {
        if (!$this->isValidIndex($indexFrom)) {
            throw CalculateException::incorrectIndex();
        }
        $this->indexFrom = $indexFrom;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTo(): ?string
    {
        return $this->indexTo;
    }

    /**
     * @param string $indexTo
     *
     * @return self
     * @throws \Appwilio\RussianPostSDK\Dispatching\Exceptions\CalculateException
     */
    public function to(string $indexTo): self
    {
        if (!$this->isValidIndex($indexTo)) {
            throw CalculateException::incorrectIndex();
        }
        $this->indexTo = $indexTo;

        return $this;
    }

    /**
     * @param MailCategory $category
     *
     * @return self
     */
    public function setCategory(MailCategory $category): self
    {
        $this->mailCategory = $category;

        return $this;
    }

    /**
     * @return \Appwilio\RussianPostSDK\Dispatching\Calculate\MailCategory
     */
    public function getCategory(): MailCategory
    {
        return $this->mailCategory;
    }

    /**
     * @param \Appwilio\RussianPostSDK\Dispatching\Calculate\MailType $type
     *
     * @return self
     */
    public function setType(MailType $type): self
    {
        $this->mailType = $type;

        return $this;
    }

    /**
     * @return \Appwilio\RussianPostSDK\Dispatching\Calculate\MailType
     */
    public function getType(): MailType
    {
        return $this->mailType;
    }

    /**
     * @param int $weight
     *
     * @return \Appwilio\RussianPostSDK\Dispatching\Calculate\Calculate
     */
    public function setWeight(int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * @param \Appwilio\RussianPostSDK\Dispatching\Calculate\PaymentMethod|null $method
     *
     * @return self
     */
    public function setPayment(?PaymentMethod $method): self
    {
        $this->paymentMethod = $method;

        return $this;
    }

    /**
     * @return \Appwilio\RussianPostSDK\Dispatching\Calculate\PaymentMethod|null
     */
    public function getPayment(): ?PaymentMethod
    {
        return $this->paymentMethod;
    }

    /**
     * @param bool $value
     *
     * @return $this
     */
    public function setWithOrderOfNotice(bool $value): self
    {
        $this->withOrderOfNotice = $value;

        return $this;
    }

    /**
     * @return bool
     */
    public function getWithOrderOfNotice(): bool
    {
        return $this->withOrderOfNotice;
    }

    /**
     * @param bool $value
     *
     * @return self
     */
    public function setWithSimpleNotice(bool $value): self
    {
        $this->withSimpleNotice = $value;

        return $this;
    }

    /**
     * @return bool
     */
    public function getWithSimpleNotice(): bool
    {
        return $this->withSimpleNotice;
    }

    /**
     * @param string $index
     *
     * @return bool
     */
    private function isValidIndex(string $index)
    {
        return is_numeric($index);
    }
}
