<?php

/**
 * This file is part of RussianPost SDK package.
 *
 * @author Anton Kartsev <anton@alarm.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Dispatching\Calculate;

use Appwilio\RussianPostSDK\Dispatching\Calculate\MailCategory;
use Appwilio\RussianPostSDK\Dispatching\Exceptions\MailCategoryException;
use PHPUnit\Framework\TestCase;

class MailCategoryTestCase extends TestCase
{
    public function testBase(): void
    {
        $categoryName = MailCategory::SIMPLE;
        $category = new MailCategory($categoryName);

        $this->assertEquals($category->getName(), $categoryName);
    }

    public function testValidException(): void
    {
        $this->expectException(MailCategoryException::class);
        new MailCategory('NOT_VALID_CATEGORY');
    }
}
