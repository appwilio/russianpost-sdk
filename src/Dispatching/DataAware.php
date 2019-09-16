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

namespace Appwilio\RussianPostSDK\Dispatching;

trait DataAware
{
    /** @var array */
    private $data = [];

    /**
     * @param  string       $key
     * @param  string|null  $type
     *
     * @return mixed
     */
    private function get(string $key, ?string $type = null)
    {
        $value = $this->data[$key] ?? null;

        if (null !== $value && null !== $type) {
            \settype($value, $type);
        }

        return $value;
    }

    public function toArray(): array
    {
        return $this->data;
    }
}
