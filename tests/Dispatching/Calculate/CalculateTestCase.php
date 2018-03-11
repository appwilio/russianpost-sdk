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

use Appwilio\RussianPostSDK\Dispatching\Calculate\Calculate;
use Appwilio\RussianPostSDK\Dispatching\Calculate\MailCategory;
use Appwilio\RussianPostSDK\Dispatching\Calculate\MailType;
use Appwilio\RussianPostSDK\Dispatching\Calculate\PaymentMethod;
use Appwilio\RussianPostSDK\Dispatching\Exceptions\CalculateException;
use PHPUnit\Framework\TestCase;

class CalculateTestCase extends TestCase
{
    public function testBase(): void
    {
        $calculate = $this->getCalculate()->from('121232')->to('543123');
        $this->assertEquals($calculate->getFrom(), '121232');
        $this->assertEquals($calculate->getTo(), '543123');
    }

    public function testCourier(): void
    {
        $calculate = $this->getCalculate()->setCourier(true);
        $this->assertTrue($calculate->isCourier());

        $calculate->setCourier(false);
        $this->assertFalse($calculate->isCourier());

        $calculate->setCourier(null);
        $this->assertNull($calculate->isCourier());
    }

    public function testDeclaredValue(): void
    {
        $calculate = $this->getCalculate()->setDeclaredValue(500);
        $this->assertEquals($calculate->getDeclaredValue(), 500);

        $calculate->setDeclaredValue(null);
        $this->assertNull($calculate->getDeclaredValue());
    }

    public function testHeight(): void
    {
        $calculate = $this->getCalculate()->setHeight(500);
        $this->assertEquals($calculate->getHeight(), 500);

        $calculate->setHeight(null);
        $this->assertNull($calculate->getHeight());
    }

    public function testLength(): void
    {
        $calculate = $this->getCalculate()->setLength(500);
        $this->assertEquals($calculate->getLength(), 500);

        $calculate->setLength(null);
        $this->assertNull($calculate->getLength());
    }

    public function testWidth(): void
    {
        $calculate = $this->getCalculate()->setWidth(500);
        $this->assertEquals($calculate->getWidth(), 500);

        $calculate->setWidth(null);
        $this->assertNull($calculate->getWidth());
    }

    public function testFragile(): void
    {
        $calculate = $this->getCalculate()->setFragile(true);
        $this->assertTrue($calculate->isFragile());

        $calculate->setFragile(false);
        $this->assertFalse($calculate->isFragile());

        $calculate->setFragile(null);
        $this->assertNull($calculate->isFragile());
    }

    public function testFromValidException(): void
    {
        $this->expectException(CalculateException::class);
        $this->getCalculate()->from('not valid index');
    }

    public function testToValidException(): void
    {
        $this->expectException(CalculateException::class);
        $this->getCalculate()->to('not valid index');
    }

    public function testCategory(): void
    {
        $category = new MailCategory(MailCategory::COMBINED);
        $calculate = $this->getCalculate()->setCategory($category);
        $this->assertEquals($calculate->getCategory(), $category);
    }

    public function testType(): void
    {
        $type = new MailType(MailType::COMBINED);
        $calculate = $this->getCalculate()->setType($type);
        $this->assertEquals($calculate->getType(), $type);
    }

    public function testWeight(): void
    {
        $calculate = $this->getCalculate()->setWeight(500);
        $this->assertEquals($calculate->getWeight(), 500);
    }

    public function testPayment(): void
    {
        $payment = new PaymentMethod(PaymentMethod::CASHLESS);
        $calculate = $this->getCalculate()->setPayment($payment);
        $this->assertEquals($calculate->getPayment(), $payment);
        $calculate->setPayment(null);
        $this->assertNull($calculate->getPayment());
    }

    public function testWithOrderOfNotice(): void
    {
        $calculate = $this->getCalculate()->setWithOrderOfNotice(true);
        $this->assertTrue($calculate->getWithOrderOfNotice());

        $calculate->setWithOrderOfNotice(false);
        $this->assertFalse($calculate->getWithOrderOfNotice());
    }

    public function testWithSimpleNotice(): void
    {
        $calculate = $this->getCalculate()->setWithSimpleNotice(true);
        $this->assertTrue($calculate->getWithSimpleNotice());

        $calculate->setWithSimpleNotice(false);
        $this->assertFalse($calculate->getWithSimpleNotice());
    }

    /**
     * @return \Appwilio\RussianPostSDK\Dispatching\Calculate\Calculate
     */
    private function getCalculate(): Calculate
    {
        return (new Calculate(
            new MailCategory(MailCategory::SIMPLE),
            new MailType(MailType::POSTAL_PARCEL)
        ));
    }
}
