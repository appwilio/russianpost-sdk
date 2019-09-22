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

namespace Appwilio\RussianPostSDK\Tracking\Single;

final class TrackingEventItemParameters
{
    /** @var string */
    private $Barcode;

    /** @var string|null */
    private $Internum;

    /** @var string */
    private $ValidRuType;

    /** @var string */
    private $ValidEnType;

    /** @var string */
    private $ComplexItemName;

    /** @var Parameter */
    private $MailRank;

    /** @var Parameter */
    private $PostMark;

    /** @var Parameter */
    private $MailType;

    /** @var Parameter */
    private $MailCtg;

    /** @var string */
    private $Mass;

    /** @var string */
    private $MaxMassRu;

    /** @var string */
    private $MaxMassEn;

    /**
     * Идентификатор (ШПИ) почтового отправления, текущий для данной операции (Barcode).
     *
     * @return string
     */
    public function getBarcode(): string
    {
        return $this->Barcode;
    }

    /**
     * Служебная информация, идентифицирующая отправление, может иметь значение ДМ квитанции,
     * связанной с отправлением или иметь значение `null` (Internum).
     *
     * @return string|null
     */
    public function getInternum(): ?string
    {
        return $this->Internum;
    }

    /**
     * Признак корректности вида и категории отправления для внутренней пересылки (ValidRuType).
     *
     * @return string
     */
    public function getValidDomesticType(): string
    {
        return $this->ValidRuType;
    }

    /**
     * Признак корректности вида и категории отправления для международной пересылки (ValidEnType).
     *
     * @return string
     */
    public function getValidInternationalType(): string
    {
        return $this->ValidEnType;
    }

    /**
     * Текстовое описание вида и категории отправления (ComplexItemName).
     *
     * @return string
     */
    public function getItemDescription(): string
    {
        return $this->ComplexItemName;
    }

    /**
     * Информация о разряде почтового отправления (MailRank).
     *
     * @link https://tracking.pochta.ru/support/dictionaries/mailrank
     *
     * @return Parameter
     */
    public function getMailRank(): Parameter
    {
        return $this->MailRank;
    }

    /**
     * Информация об отметках почтовых отправлений (PostMark).
     *
     * @link https://tracking.pochta.ru/support/dictionaries/postmark
     *
     * @return Parameter
     */
    public function getPostMark(): Parameter
    {
        return $this->PostMark;
    }

    /**
     * Данные о виде почтового отправления (MailType).
     *
     * @link https://tracking.pochta.ru/support/dictionaries/mailtype
     *
     * @return Parameter
     */
    public function getMailType(): Parameter
    {
        return $this->MailType;
    }

    /**
     * Данные о категории почтового отправления (MailCtg).
     *
     * @link https://tracking.pochta.ru/support/dictionaries/category_codes
     *
     * @return Parameter
     */
    public function getMailCategory(): Parameter
    {
        return $this->MailCtg;
    }

    /**
     * Вес отправления в граммах (Mass).
     *
     * @return int
     */
    public function getWeight(): int
    {
        return (int) $this->Mass;
    }

    /**
     * Значение максимально возможного веса для данного вида и категории отправления для внутренней пересылки (MaxMassRu).
     *
     * @return int
     */
    public function getMaxDomesticWeight(): int
    {
        return (int) $this->MaxMassRu;
    }

    /**
     * Значение максимально возможного веса для данного вида и категории отправления для международной пересылки (MaxMassEn).
     *
     * @return int
     */
    public function getMaxInternationalWeight(): int
    {
        return (int) $this->MaxMassEn;
    }
}
