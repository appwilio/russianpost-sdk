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

use Appwilio\RussianPostSDK\Dispatching\Exceptions\MailCategoryException;


class MailCategory
{
    /**
     * Mail categories @see https://otpravka.pochta.ru/specification#/enums-base-mail-category
     */
    public const SIMPLE = 'SIMPLE';
    public const ORDERED = 'ORDERED';
    public const ORDINARY = 'ORDINARY';
    public const DECLARED = 'WITH_DECLARED_VALUE';
    public const DECLARED_CASH = 'WITH_DECLARED_VALUE_AND_CASH_ON_DELIVERY';
    public const COMBINED = 'COMBINED';

    /**
     * @var array
     */
    private $allowedCategories = [
        self::SIMPLE,
        self::ORDERED,
        self::ORDINARY,
        self::DECLARED,
        self::DECLARED_CASH,
        self::COMBINED,
    ];

    /**
     * @var string
     */
    private $name;

    /**
     * MailCategory constructor.
     *
     * @param string $name
     *
     * @throws \Appwilio\RussianPostSDK\Dispatching\Exceptions\MailCategoryException
     */
    public function __construct(string $name)
    {
        if (!$this->isCategoryValid($name)) {
            throw MailCategoryException::incorrectCategory();
        }

        $this->setCategory($name);
    }

    /**
     * @param string $name
     *
     * @return self
     */
    private function setCategory(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    private function isCategoryValid(string $name): bool
    {
        return in_array($name, $this->allowedCategories);
    }
}
