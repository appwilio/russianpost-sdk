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

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Batches\Requests;

use Appwilio\RussianPostSDK\Core\Arrayable;
use Appwilio\RussianPostSDK\Dispatching\Enum\MailType;
use Appwilio\RussianPostSDK\Dispatching\Enum\MailCategory;

final class FindBatchRequest implements Arrayable
{
    private $data = [];

    public static function create(): self
    {
        return new self();
    }

    public function ofMailCategory(MailCategory $category)
    {
        $this->data['mailCategory'] = $category;

        return $this;
    }

    public function ofMailType(MailType $type)
    {
        $this->data['mailType'] = $type;

        return $this;
    }

    public function sortAsc()
    {
        $this->data['sort'] = 'asc';

        return $this;
    }

    public function sortDesc()
    {
        $this->data['sort'] = 'desc';

        return $this;
    }

    public function page(int $page)
    {
        $this->data['page'] = $page;

        return $this;
    }

    public function perPage(int $number)
    {
        $this->data['size'] = $number;

        return $this;
    }

    public function toArray(): array
    {
        return $this->data;
    }
}
