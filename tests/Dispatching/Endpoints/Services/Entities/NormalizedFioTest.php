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

namespace Appwilio\RussianPostSDK\Tests\Dispatching\Endpoints\Services\Entities;

use Appwilio\RussianPostSDK\Tests\TestCase;
use Appwilio\RussianPostSDK\Dispatching\Instantiator;
use Appwilio\RussianPostSDK\Dispatching\Enum\FioQuality;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Entities\NormalizedFio;

class NormalizedFioTest extends TestCase
{
    public function test_can_get_data(): void
    {
        /** @var NormalizedFio $instance */
        $instance = Instantiator::instantiate(NormalizedFio::class, [
            'id'           => ($id = \md5('123')),
            'name'         => ($firstName = 'Иван'),
            'middle-name'  => ($middleName = 'Иванович'),
            'surname'      => ($lastName = 'Иванов'),
            'original-fio' => ($original = 'Иванов Иван Иванович'),
            'quality-code' => ($quality = FioQuality::EDITED()->getValue()),
        ]);

        $this->assertEquals($id, $instance->getId());
        $this->assertEquals($firstName, $instance->getFirstName());
        $this->assertEquals($lastName, $instance->getLastName());
        $this->assertEquals($middleName, $instance->getMiddleName());
        $this->assertEquals($original, $instance->getOriginalFio());
        $this->assertEquals(new FioQuality($quality), $instance->getQualityCode());
    }
}
