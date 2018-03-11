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

interface CalculateInterface
{
    public function isCourier(): ?bool;

    public function setCourier(?bool $value);

    public function getDeclaredValue(): ?int;

    public function setDeclaredValue(?int $value);

    public function getHeight(): ?int;

    public function setHeight(?int $value);

    public function getLength(): ?int;

    public function setLength(?int $value);

    public function getWidth(): ?int;

    public function setWidth(?int $value);

    public function isFragile(): ?bool;

    public function setFragile(?bool $value);

    public function getFrom(): ?string ;

    public function from(string $indexFrom);

    public function getTo(): ?string ;

    public function to(string $indexTo);

    public function setCategory(MailCategory $category);

    public function getCategory(): MailCategory;

    public function setType(MailType $type);

    public function getType(): MailType;

    public function setWeight(int $weight);

    public function getWeight(): int;

    public function setPayment(?PaymentMethod $method);

    public function getPayment(): ?PaymentMethod;

    public function setWithOrderOfNotice(bool $value);

    public function getWithOrderOfNotice(): bool;

    public function setWithSimpleNotice(bool $value);

    public function getWithSimpleNotice(): bool;
}