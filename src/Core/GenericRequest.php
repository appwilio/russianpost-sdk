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

namespace Appwilio\RussianPostSDK\Core;

final class GenericRequest implements Arrayable
{
    /** @var array */
    private $data;

    public static function create(iterable $data): self
    {
        return new self($data);
    }

    public function __construct(iterable $data)
    {
        if ($data instanceof \Traversable) {
            $data = \iterator_to_array($data);
        }

        $this->data = $data;
    }

    public function toArray(): array
    {
        return $this->data;
    }
}
