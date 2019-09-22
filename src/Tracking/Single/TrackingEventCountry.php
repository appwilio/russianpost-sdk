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

final class TrackingEventCountry
{
    /** @var int */
    private $Id;

    /** @var string */
    private $Code2A;

    /** @var string */
    private $Code3A;

    /** @var string */
    private $NameRU;

    /** @var string */
    private $NameEN;

    /**
     * Код страны.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->Id;
    }

    /**
     * Двухбуквенный идентификатор страны.
     *
     * @link https://tracking.pochta.ru/support/dictionaries/countries
     *
     * @return string
     */
    public function getCode2A(): string
    {
        return $this->Code2A;
    }

    /**
     * Трехбуквенный идентификатор страны.
     *
     * @link https://tracking.pochta.ru/support/dictionaries/countries
     *
     * @return string
     */
    public function getCode3A(): string
    {
        return $this->Code3A;
    }

    /**
     * Российское название страны.
     *
     * @link https://tracking.pochta.ru/support/dictionaries/countries
     *
     * @return string
     */
    public function getNameRU(): string
    {
        return $this->NameRU;
    }

    /**
     * Международное название страны.
     *
     * @link https://tracking.pochta.ru/support/dictionaries/countries
     *
     * @return string
     */
    public function getNameEN(): string
    {
        return $this->NameEN;
    }
}
